<?php
namespace App\Controllers;

class ChatController extends BaseController
{
    public function chat($usuarioDestinoId)
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login');
        }
        
        $db = \Config\Database::connect();
        $encrypter = \Config\Services::encrypter();
        $miId = session()->get('usuario_id');

        // Get destination user info
        $destino = $db->table('usuarios')
            ->select('id, nombre')
            ->where('id', $usuarioDestinoId)
            ->get()
            ->getRowArray();

        // Find or create conversation
        $builder = $db->table('conversaciones');
        $conversacion = $builder
            ->groupStart()
                ->where('usuario1_id', $miId)
                ->where('usuario2_id', $usuarioDestinoId)
            ->groupEnd()
            ->orGroupStart()
                ->where('usuario1_id', $usuarioDestinoId)
                ->where('usuario2_id', $miId)
            ->groupEnd()
            ->get()
            ->getRowArray();

        if (!$conversacion) {
            $builder->insert([
                'usuario1_id' => $miId,
                'usuario2_id' => $usuarioDestinoId,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            $conversacionId = $db->insertID();
        } else {
            $conversacionId = $conversacion['id'];
        }

        // Get messages
        $mensajes = $db->table('mensajes')
            ->where('conversacion_id', $conversacionId)
            ->orderBy('id', 'ASC')
            ->get()
            ->getResultArray();

        foreach ($mensajes as &$m) {
            if (!empty($m['mensaje_cifrado'])) {
                try {
                    $m['mensaje'] = $encrypter->decrypt(base64_decode($m['mensaje_cifrado']));
                } catch (\Exception $e) {
                    $m['mensaje'] = '[No se pudo descifrar]';
                }
            }
        }

        return view('chat/chat', [
            'conversacion_id' => $conversacionId,
            'mensajes' => $mensajes,
            'destino_id' => $usuarioDestinoId,
            'destino_nombre' => $destino['nombre'] ?? 'Usuario'
        ]);
    }

    public function enviar()
    {
        $db = \Config\Database::connect();
        $encrypter = \Config\Services::encrypter();
        $mensaje = $this->request->getPost('mensaje');
        $archivo = $this->request->getFile('archivo');
        $tipo = 'texto';
        $nombreArchivo = null;

        if ($archivo && $archivo->isValid() && !$archivo->hasMoved()) {
            $extension = $archivo->getExtension();
            $nombreArchivo = $archivo->getRandomName();
            $archivo->move('uploads', $nombreArchivo);
            if (in_array($extension, ['jpg','jpeg','png','gif'])) $tipo = 'imagen';
            if (in_array($extension, ['mp4','mov','webm'])) $tipo = 'video';
        }

        $mensajeCifrado = null;
        if ($mensaje) {
            $mensajeCifrado = base64_encode($encrypter->encrypt($mensaje));
        }

        $db->table('mensajes')->insert([
            'conversacion_id' => $this->request->getPost('conversacion_id'),
            'remitente_id' => session()->get('usuario_id'),
            'mensaje_cifrado' => $mensajeCifrado,
            'archivo' => $nombreArchivo,
            'tipo' => $tipo,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/chat/' . $this->request->getPost('destino_id'));
    }

    public function obtenerMensajes($conversacionId)
    {
        $db = \Config\Database::connect();
        $encrypter = \Config\Services::encrypter();

        $mensajes = $db->table('mensajes')
            ->where('conversacion_id', $conversacionId)
            ->orderBy('id', 'ASC')
            ->get()
            ->getResultArray();

        foreach ($mensajes as &$m) {
            if (!empty($m['mensaje_cifrado'])) {
                try {
                    $m['mensaje'] = $encrypter->decrypt(base64_decode($m['mensaje_cifrado']));
                } catch (\Exception $e) {
                    $m['mensaje'] = '[Error]';
                }
            }
        }

        return $this->response->setJSON($mensajes);
    }

    // API ENDPOINTS FOR MOBILE APP

    public function apiUsuarios()
    {
        $miId = $this->request->getGet('mi_id');
        $db = \Config\Database::connect();

        $usuarios = $db->table('usuarios')
            ->select('id, nombre, email')
            ->where('id !=', $miId)
            ->get()
            ->getResultArray();

        return $this->response->setJSON([
            'success' => true,
            'usuarios' => $usuarios
        ]);
    }

    public function apiConversacion()
    {
        $miId = $this->request->getPost('mi_id');
        $destinoId = $this->request->getPost('destino_id');
        $db = \Config\Database::connect();

        $conversacion = $db->table('conversaciones')
            ->groupStart()
                ->where('usuario1_id', $miId)
                ->where('usuario2_id', $destinoId)
            ->groupEnd()
            ->orGroupStart()
                ->where('usuario1_id', $destinoId)
                ->where('usuario2_id', $miId)
            ->groupEnd()
            ->get()
            ->getRowArray();

        if (!$conversacion) {
            $db->table('conversaciones')->insert([
                'usuario1_id' => $miId,
                'usuario2_id' => $destinoId,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            $conversacionId = $db->insertID();
        } else {
            $conversacionId = $conversacion['id'];
        }

        return $this->response->setJSON([
            'success' => true,
            'conversacion_id' => $conversacionId
        ]);
    }

    public function apiMensajes()
    {
        $conversacionId = $this->request->getGet('conversacion_id');
        $ultimoId = $this->request->getGet('ultimo_id') ?? 0;
        $db = \Config\Database::connect();
        $encrypter = \Config\Services::encrypter();

        $mensajes = $db->table('mensajes')
            ->where('conversacion_id', $conversacionId)
            ->where('id >', $ultimoId)
            ->orderBy('id', 'ASC')
            ->get()
            ->getResultArray();

        foreach ($mensajes as &$m) {
            if (!empty($m['mensaje_cifrado'])) {
                try {
                    $m['mensaje'] = $encrypter->decrypt(base64_decode($m['mensaje_cifrado']));
                } catch (\Exception $e) {
                    $m['mensaje'] = '[Error al descifrar]';
                }
            }
            if (!empty($m['archivo'])) {
                $m['archivo_url'] = base_url('uploads/' . $m['archivo']);
            }
        }

        return $this->response->setJSON([
            'success' => true,
            'mensajes' => $mensajes
        ]);
    }

    public function apiEnviar()
    {
        $db = \Config\Database::connect();
        $encrypter = \Config\Services::encrypter();

        $conversacionId = $this->request->getPost('conversacion_id');
        $remitenteId = $this->request->getPost('remitente_id');
        $mensaje = $this->request->getPost('mensaje');

        if (empty($conversacionId) || empty($remitenteId) || empty($mensaje)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Datos incompletos'
            ]);
        }

        $mensajeCifrado = base64_encode($encrypter->encrypt($mensaje));

        $db->table('mensajes')->insert([
            'conversacion_id' => $conversacionId,
            'remitente_id' => $remitenteId,
            'mensaje_cifrado' => $mensajeCifrado,
            'tipo' => 'texto',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $nuevoId = $db->insertID();

        return $this->response->setJSON([
            'success' => true,
            'mensaje' => [
                'id' => $nuevoId,
                'conversacion_id' => $conversacionId,
                'remitente_id' => $remitenteId,
                'mensaje' => $mensaje,
                'tipo' => 'texto',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
