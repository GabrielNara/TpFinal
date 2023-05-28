<?php
include_once('./model/UsuarioModel.php');
class PerfilJugadorController {
    private $renderer;

    private $usuarioModel;
    public function __construct($renderer, $usuarioModel) {
        $this->renderer = $renderer;
        $this->usuarioModel = $usuarioModel;
    }

    public function list() {
        $this->renderer->render("perfilJugador");
    }
    public function getPerfil() {
        if (isset($_GET['idUsuario'])) {
            $idUsuario = $_GET['idUsuario'];

            $data["usuario"] = $this->usuarioModel->getUsuarioById($idUsuario);



                $this->renderer->render("perfilJugador", $data);

        }else{
            $this->renderer->render("perfilJugador");
        }

    }
}