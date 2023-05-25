<?php
include_once('./model/UsuarioModel.php');

class LoginController
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
        $this->renderer->render("login");
    }

    public function loguearse()
    {

        $user = $_POST['username'];
        $pass = $_POST['password'];

        $data["usuario"] = $this->usuarioModel->getUsuario($user, $pass);
        $this->renderer->render("lobby", $data);

    }
}