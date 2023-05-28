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

    public function irLogin()
    {
        $this->renderer->render("login");
    }

    public function validarLogin()
    {

        $user = $_POST['username'];
        $pass = $_POST['password'];

        $data["usuario"] = $this->usuarioModel->getUsuarioByUserAndPassword($user, $pass);

        if (empty($data["usuario"])) {
            $error["msj"] = "Usuario o clave incorrecta";
            $this->renderer->render("login", $error);
        } else {


            $this->renderer->render("lobby", $data);
        }
    }
}