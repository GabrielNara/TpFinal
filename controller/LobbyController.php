<?php
include_once('./model/LobbyModel.php');

class LobbyController
{
    private $renderer;
    private $lobbyModel;

    public function __construct($renderer, $lobbyModel)
    {
        $this->renderer = $renderer;
        $this->lobbyModel = $lobbyModel;
    }

    public function list()
    {
        $data['usuario'] = $_SESSION['usuario'];
        if (!isset($_SESSION['usuario'])) {
            header('Location: /tpfinal/');
            exit();
        } else if ($this->lobbyModel->estaValidadoElCorreoUsuario($_SESSION['usuario']['email']) == 1) {
            $this->renderer->render('lobby', $data);
        } else {
            $this->renderer->render('faltaConfirmarMail', $data);
        }

    }

    public function cerrarSesion()
    {
        session_destroy();
        header('Location: /tpfinal/');
        exit();
    }
}