<?php

class LobbyController
{
    private $renderer;

    public function __construct($renderer)
    {
        $this->renderer = $renderer;
    }

    public function list()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /tpfinal/');
            exit();
        } else {
            $this->renderer->render('lobby');
        }
    }

    public function cerrarSesion()
    {
        session_destroy();
        header('Location: /tpfinal/');
        exit();
    }
}