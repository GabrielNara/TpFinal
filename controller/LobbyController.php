<?php
include_once('./model/LobbyModel.php');
include_once('./model/RankingModel.php');

class LobbyController
{
    private $renderer;
    private $lobbyModel;
    private $rankingModel;

    public function __construct($renderer, $lobbyModel, $rankingModel)
    {
        $this->renderer = $renderer;
        $this->lobbyModel = $lobbyModel;
        $this->rankingModel = $rankingModel;
    }

    public function list()
    {
        $usuario = $_SESSION['usuario'];
        if ($this->lobbyModel->estaValidadoElCorreoUsuario($usuario['email']) == 1) {
            $mayorPuntaje = $this->rankingModel->obtenerMayorPuntaje($usuario["id"]);
            $historial = $this->rankingModel->obtenerHistorial($usuario["id"]);
            $rol = $this->lobbyModel->getRol($usuario["id"]);
            $data = array(
                'usuario' => $usuario,
                'puntajeMayor' => $mayorPuntaje[0]["puntajeTotal"],
                'historial' => $historial
            );

            if ($rol[0]['idRol'] == 2) {
                $data['rol'] = 'editor';
            }

            $this->renderer->render('lobby', $data);
        } else {
            $data = array(
                'usuario' => $usuario
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