<?php
include_once('./model/LobbyModel.php');

class LobbyController
{
    private $renderer;
    private $lobbyModel;
    private $partidaModel;

    public function __construct($renderer, $lobbyModel, $partidaModel)
    {
        $this->renderer = $renderer;
        $this->lobbyModel = $lobbyModel;
        $this->partidaModel = $partidaModel;
    }

    public function list()
    {
        $usuario = $_SESSION['usuario'];

        if (!isset($_SESSION['usuario'])) {
            header('Location: /tpfinal/');
            exit();
        } else if ($this->lobbyModel->estaValidadoElCorreoUsuario($_SESSION['usuario']['email']) == 1) {
            $puntajeMayor = $this->partidaModel->obtenerMayorPuntaje($usuario["id"]);
                
            $historial = $this->partidaModel->obtenerHistorial($usuario["id"]);


            $data = array(
                'usuario' => $_SESSION['usuario'],
                'puntajeMayor' => $puntajeMayor[0]["puntajeTotal"],
                'historial' => $historial
            );

            $this->renderer->render('lobby', $data);
        } else {
            $data = array(
                'usuario' => $_SESSION['usuario']
            );
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