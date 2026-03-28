<?php

namespace App\Controllers;

class GrupoController extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $grupos = $db->table('grupos')->get()->getResultArray();

        return view('grupos/index', [
            'grupos' => $grupos
        ]);
    }

    public function crear()
    {
        return view('grupos/crear');
    }

    public function guardar()
    {
        $db = \Config\Database::connect();

        $db->table('grupos')->insert([
            'nombre' => $this->request->getPost('nombre'),
            'creador_id' => session()->get('usuario_id')
        ]);

        return redirect()->to('/grupos');
    }

    public function chat($id)
    {
        $db = \Config\Database::connect();

        $mensajes = $db->table('mensajes_grupo')
            ->where('grupo_id', $grupo_id)
            ->orderBy('created_at','ASC')
            ->get()
            ->getResultArray();

        return view('grupos/chat', [
            'mensajes' => $mensajes,
            'grupo_id' => $id
        ]);
    }

    public function enviarMensaje()
    {
        $db = \Config\Database::connect();

        $grupo_id = $this->request->getPost('grupo_id');

        $db->table('mensajes_grupo')->insert([
            'grupo_id' => $grupo_id,
            'remitente_id' => session()->get('usuario_id'),
            'mensaje' => $this->request->getPost('mensaje')
    ]);

        return redirect()->to('/grupo_chat/' . $this->request->getPost('grupo_id'));

    }
}
