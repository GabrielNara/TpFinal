<?php
include_once('./model/UsuarioModel.php');

class PerfilJugadorController {
    private $renderer;
    private $usuarioModel;
    private $partidaModel;

    public function __construct($renderer, $usuarioModel, $partidaModel)
    {
        $this->renderer = $renderer;
        $this->usuarioModel = $usuarioModel;
        $this->partidaModel = $partidaModel;
    }

    public function list() {
        $id = $_GET['id'];
        $usuario = $this->usuarioModel->getUsuarioPorId($id);
        $ranking = $this->partidaModel->obtenerElRanking();

        $resultado = array_values(array_filter($ranking, function ($item) use ($id) {
            return $item["id"] == $id;
        }));
        $datos = array(
            'ranking' => $resultado[0],
            'usuario' => $usuario[0]
        );
      //  var_dump($ranking[id]);
        $this->renderer->render("perfilJugador", $datos);
    }
}