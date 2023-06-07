<?php
include_once('./model/UsuarioModel.php');
include_once('./model/RankingModel.php');

class PerfilJugadorController {
    private $renderer;
    private $usuarioModel;
    private $rankingModel;

    public function __construct($renderer, $usuarioModel, $rankingModel)
    {
        $this->renderer = $renderer;
        $this->usuarioModel = $usuarioModel;
        $this->rankingModel = $rankingModel;
    }

    public function list() {
        $id = $_GET['id'];
        $usuario = $this->usuarioModel->getUsuarioPorId($id);
        $ranking = $this->rankingModel->obtenerElRanking();

        $resultado = array_values(array_filter($ranking, function ($item) use ($id) {
            return $item["id"] == $id;
        }));

        $datos = array(
            'ranking' => $resultado[0],
            'usuario' => $usuario[0]
        );

        $this->renderer->render("perfilJugador", $datos);
    }
}