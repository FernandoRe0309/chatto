<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class AuthController extends BaseController
{
    // ============================================================
    // MÉTODOS WEB (para el sitio en el navegador)
    // ============================================================

    /**
     * Muestra el formulario de registro
     */
    public function registro()
    {
        return view('auth/registro');
    }

    /**
     * Guarda un nuevo usuario
     */
    public function guardarRegistro()
    {
        $usuarioModel = new UsuarioModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('password_confirm');

        // Verificar que las contraseñas coincidan
        if ($password !== $passwordConfirm) {
            return redirect()->back()->with('error', 'Las contraseñas no coinciden');
        }

        // Verificar que no haya espacios en la contraseña
        if (strpos($password, ' ') !== false) {
            return redirect()->back()->with('error', 'La contraseña no puede contener espacios');
        }

        // Verificar si el email ya existe
        $existente = $usuarioModel->where('email', $email)->first();
        if ($existente) {
            return redirect()->back()->with('error', 'El correo ya está registrado');
        }

        // Crear el usuario
        $usuarioModel->insert([
            'nombre'   => $this->request->getPost('nombre'),
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        return redirect()->to('/login')->with('success', 'Cuenta creada correctamente');
    }

    /**
     * Muestra el formulario de login
     */
    public function login()
    {
        return view('auth/login');
    }

    /**
     * Valida las credenciales del usuario
     */
    public function validarLogin()
    {
        $usuarioModel = new UsuarioModel();

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $usuario = $usuarioModel->where('email', $email)->first();

        if (!$usuario || !password_verify($password, $usuario['password'])) {
            return redirect()->back()->with('error', 'Credenciales incorrectas');
        }

        // Crear sesión
        session()->set([
            'usuario_id' => $usuario['id'],
            'nombre'     => $usuario['nombre'],
            'email'      => $usuario['email'],
            'logueado'   => true
        ]);

        return redirect()->to('/usuarios');
    }

    /**
     * Cierra la sesión del usuario
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    /**
     * Muestra el formulario de recuperación de contraseña
     */
    public function forgotForm()
    {
        return view('auth/forgot');
    }

    /**
     * Envía el correo de recuperación de contraseña
     */
    public function sendReset()
    {
        $usuarioModel = new UsuarioModel();
        $email = $this->request->getPost('email');

        $usuario = $usuarioModel->where('email', $email)->first();

        if (!$usuario) {
            return redirect()->back()->with('error', 'No existe una cuenta con ese correo');
        }

        // Generar token único
        $token = bin2hex(random_bytes(32));
        $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Guardar token en la base de datos
        $usuarioModel->update($usuario['id'], [
            'reset_token'  => $token,
            'reset_expira' => $expira
        ]);

        // Enviar correo (configurar según tu servidor de correo)
        $resetUrl = base_url("reset/{$token}");
        
        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setSubject('Recuperar contraseña');
        $emailService->setMessage("
            <h2>Recuperar contraseña</h2>
            <p>Haz clic en el siguiente enlace para restablecer tu contraseña:</p>
            <p><a href='{$resetUrl}'>{$resetUrl}</a></p>
            <p>Este enlace expira en 1 hora.</p>
        ");
        
        if ($emailService->send()) {
            return redirect()->to('/login')->with('success', 'Se ha enviado un correo con las instrucciones');
        } else {
            return redirect()->back()->with('error', 'Error al enviar el correo. Inténtalo de nuevo.');
        }
    }

    /**
     * Muestra el formulario para restablecer contraseña
     */
    public function resetForm($token)
    {
        $usuarioModel = new UsuarioModel();

        $usuario = $usuarioModel
            ->where('reset_token', $token)
            ->where('reset_expira >', date('Y-m-d H:i:s'))
            ->first();

        if (!$usuario) {
            return redirect()->to('/login')->with('error', 'El enlace ha expirado o es inválido');
        }

        return view('auth/reset', ['token' => $token]);
    }

    /**
     * Restablece la contraseña del usuario
     */
    public function resetPassword()
    {
        $usuarioModel = new UsuarioModel();
        $token    = $this->request->getPost('token');
        $password = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('password_confirm');

        if ($password !== $passwordConfirm) {
            return redirect()->back()->with('error', 'Las contraseñas no coinciden');
        }

        $usuario = $usuarioModel
            ->where('reset_token', $token)
            ->where('reset_expira >', date('Y-m-d H:i:s'))
            ->first();

        if (!$usuario) {
            return redirect()->to('/login')->with('error', 'El enlace ha expirado o es inválido');
        }

        // Actualizar contraseña y limpiar token
        $usuarioModel->update($usuario['id'], [
            'password'     => password_hash($password, PASSWORD_DEFAULT),
            'reset_token'  => null,
            'reset_expira' => null
        ]);

        return redirect()->to('/login')->with('success', 'Contraseña actualizada correctamente');
    }

    /**
     * Muestra el perfil del usuario
     */
    public function perfil()
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login');
        }

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find(session()->get('usuario_id'));

        return view('auth/perfil', ['usuario' => $usuario]);
    }

    /**
     * Login con reconocimiento facial
     */
    public function loginRostro()
    {
        $db = \Config\Database::connect();
        $faceData = $this->request->getJSON(true);
        
        if (!isset($faceData['face'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No se recibió el descriptor facial'
            ]);
        }

        $faceDescriptor = $faceData['face'];

        // Obtener todos los usuarios con descriptor facial registrado
        $usuarios = $db->table('usuarios')
            ->where('face_descriptor IS NOT NULL')
            ->get()
            ->getResultArray();

        $umbral = 0.6; // Umbral de similitud (ajustar según necesidad)
        $usuarioEncontrado = null;

        foreach ($usuarios as $usuario) {
            $descriptorGuardado = json_decode($usuario['face_descriptor'], true);
            
            if ($descriptorGuardado) {
                $distancia = $this->calcularDistanciaEuclidiana($faceDescriptor, $descriptorGuardado);
                
                if ($distancia < $umbral) {
                    $usuarioEncontrado = $usuario;
                    break;
                }
            }
        }

        if ($usuarioEncontrado) {
            session()->set([
                'usuario_id' => $usuarioEncontrado['id'],
                'nombre'     => $usuarioEncontrado['nombre'],
                'email'      => $usuarioEncontrado['email'],
                'logueado'   => true
            ]);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Login exitoso'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Rostro no reconocido'
        ]);
    }

    /**
     * Calcula la distancia euclidiana entre dos descriptores faciales
     */
    private function calcularDistanciaEuclidiana($descriptor1, $descriptor2)
    {
        if (count($descriptor1) !== count($descriptor2)) {
            return PHP_FLOAT_MAX;
        }

        $suma = 0;
        for ($i = 0; $i < count($descriptor1); $i++) {
            $suma += pow($descriptor1[$i] - $descriptor2[$i], 2);
        }

        return sqrt($suma);
    }

    // ============================================================
    // ENDPOINTS API PARA LA APP ANDROID
    // ============================================================

    /**
     * POST /api/login
     * Login desde la app móvil
     */
    public function apiLogin()
    {
        $usuarioModel = new UsuarioModel();

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $usuario = $usuarioModel->where('email', $email)->first();

        if (!$usuario || !password_verify($password, $usuario['password'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Credenciales incorrectas'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'usuario' => [
                'id'     => $usuario['id'],
                'nombre' => $usuario['nombre'],
                'email'  => $usuario['email']
            ]
        ]);
    }

    /**
     * POST /api/registro
     * Registro desde la app móvil
     */
    public function apiRegistro()
    {
        $usuarioModel = new UsuarioModel();

        $nombre   = $this->request->getPost('nombre');
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Verificar si el email ya existe
        $existente = $usuarioModel->where('email', $email)->first();
        if ($existente) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'El correo ya está registrado'
            ]);
        }

        // Crear el usuario
        $usuarioModel->insert([
            'nombre'   => $nombre,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        $usuarioId = $usuarioModel->getInsertID();

        return $this->response->setJSON([
            'success' => true,
            'usuario' => [
                'id'     => $usuarioId,
                'nombre' => $nombre,
                'email'  => $email
            ]
        ]);
    }

    /**
     * POST /api/recuperar
     * Solicita recuperación de contraseña desde la app móvil
     */
    public function apiRecuperar()
    {
        $usuarioModel = new UsuarioModel();
        $email = $this->request->getPost('email');

        $usuario = $usuarioModel->where('email', $email)->first();

        if (!$usuario) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No existe una cuenta con ese correo'
            ]);
        }

        // Generar token único
        $token = bin2hex(random_bytes(32));
        $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Guardar token en la base de datos
        $usuarioModel->update($usuario['id'], [
            'reset_token'  => $token,
            'reset_expira' => $expira
        ]);

        // Enviar correo
        $resetUrl = base_url("reset/{$token}");
        
        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setSubject('Recuperar contraseña');
        $emailService->setMessage("
            <h2>Recuperar contraseña</h2>
            <p>Haz clic en el siguiente enlace para restablecer tu contraseña:</p>
            <p><a href='{$resetUrl}'>{$resetUrl}</a></p>
            <p>Este enlace expira en 1 hora.</p>
        ");
        
        if ($emailService->send()) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Se ha enviado un correo con las instrucciones'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error al enviar el correo'
            ]);
        }
    }
}
