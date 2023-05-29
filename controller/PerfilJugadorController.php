<?php
include_once('./model/UsuarioModel.php');

class PerfilJugadorController
{
    private $renderer;

    private $usuarioModel;

    public function __construct($renderer, $usuarioModel)
    {
        $this->renderer = $renderer;
        $this->usuarioModel = $usuarioModel;
    }

    public function list()
    {
        $this->renderer->render("perfilJugador");
    }

    public function getPerfil()
    {


        if (!isset($_SESSION['usuario'])) {
            header('Location: /tpfinal/');
            exit();
        } else {
            if (isset($_GET['idUsuario'])) {
                $idUsuario = $_GET['idUsuario'];

                $data["usuario"] = $this->usuarioModel->getUsuarioById($_SESSION['usuario']);


                $this->renderer->render("perfilJugador", $data);

            }
            
        }

    }
}