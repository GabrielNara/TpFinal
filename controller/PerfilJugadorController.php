<?php
include_once('./model/UsuarioModel.php');
include_once('./model/RankingModel.php');

class PerfilJugadorController
{
    private $renderer;
    private $usuarioModel;
    private $rankingModel;

    public function __construct($renderer, $usuarioModel, $rankingModel)
    {
        $this->renderer = $renderer;
        $this->usuarioModel = $usuarioModel;
        $this->rankingModel = $rankingModel;
    }

    public function list()
    {
        $id = $_GET['id'];
        $usuario = $this->usuarioModel->getUsuarioPorId($id);

        $resultado = $this->rankingModel->obtenerElRankingPorIdUsuario($id);

        $qr = $this->usuarioModel->generarQr($id);

// Mostrar la imagen del código QR
        $datos = array(
            'ranking' => $resultado[0],
            'usuario' => $usuario[0],
            'qr' => '.' . $qr
        );
        $this->renderer->render("perfilJugador", $datos);
    }
}