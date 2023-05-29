<?php
include_once('./model/UsuarioModel.php');

class LobbyController
{
    private $renderer;

    public function __construct($renderer, $usuarioModel)
    {
        $this->renderer = $renderer;
        $this->usuarioModel = $usuarioModel;
    }

    public function list()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /tpfinal/');
            exit();
        } else {

            $data["usuario"] = $this->usuarioModel->getUsuarioById($_SESSION['usuario']);

            $this->renderer->render('lobby', $data);
        }
    }

    public function cerrarSesion()
    {
        session_destroy();
        header('Location: /tpfinal/');
        exit();
    }
}