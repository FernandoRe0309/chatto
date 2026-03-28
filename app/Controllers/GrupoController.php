<?php

namespace App\Controllers;

class GrupoController extends BaseController
{
    public function index()
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login');
        }
        
        $db = \Config\Database::connect();
        $grupos = $db->table('grupos')->get()->getResultArray();

        return view('grupos/index', [
            'grupos' => $grupos
        ]);
    }

    public function crear()
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login');
        }
        
        return view('grupos/crear');
    }

    public function guardar()
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login');
        }
        
        $db = \Config\Database::connect();

        $db->table('grupos')->insert([
            'nombre' => $this->request->getPost('nombre'),
            'creador_id' => session()->get('usuario_id'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
        
        $grupoId = $db->insertID();
        
        // Add creator as member
        $db->table('grupo_miembros')->insert([
            'grupo_id' => $grupoId,
            'usuario_id' => session()->get('usuario_id')
        ]);

        return redirect()->to('/grupos');
    }

    public function chat($id)
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login');
        }
        
        $db = \Config\Database::connect();
        
        // Get group info
        $grupo = $db->table('grupos')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        // Get messages with sender names
        $mensajes = $db->table('mensajes_grupo')
            ->select('mensajes_grupo.*, usuarios.nombre as nombre_remitente')
            ->join('usuarios', 'usuarios.id = mensajes_grupo.remitente_id', 'left')
            ->where('grupo_id', $id)
            ->orderBy('mensajes_grupo.created_at', 'ASC')
            ->get()
            ->getResultArray();

        return view('grupos/chat', [
            'mensajes' => $mensajes,
            'grupo_id' => $id,
            'grupo_nombre' => $grupo['nombre'] ?? 'Grupo'
        ]);
    }

    public function enviarMensaje()
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login');
        }
        
        $db = \Config\Database::connect();
        $grupoId = $this->request->getPost('grupo_id');

        $db->table('mensajes_grupo')->insert([
            'grupo_id' => $grupoId,
            'remitente_id' => session()->get('usuario_id'),
            'mensaje' => $this->request->getPost('mensaje'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/grupo_chat/' . $grupoId);
    }
}
