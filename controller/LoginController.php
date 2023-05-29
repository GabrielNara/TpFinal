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

        $data["usuario"] = $this->usuarioModel->getUsuarioByUserAndPassword($user, $pass);

        if (empty($data["usuario"])) {
            $error["msj"] = "Usuario o clave incorrecta";
            $this->renderer->render("login", $error);
        } else {
            $_SESSION['usuario'] = $data["usuario"][0][0];
            $this->renderer->render("lobby", $data);

        }
    }
}