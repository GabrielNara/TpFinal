<?php
include_once('./model/UsuarioModel.php');

class PerfilJugadorController {
    private $renderer;
    private $usuarioModel;

    public function __construct($renderer, $usuarioModel)
    {
        $this->renderer = $renderer;
        $this->usuarioModel = $usuarioModel;
    }

    public function list() {
        $id = $_GET['id'];
        $usuario = $this->usuarioModel->getUsuarioPorId($id);
        $this->renderer->render("perfilJugador", $usuario[0]);
    }
}