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

        $usuario = $this->usuarioModel->getUsuario($user, $pass);

        if (empty($usuario)) {
            $error["msj"] = "Usuario o clave incorrecta";
            $this->renderer->render("login", $error);
        } else {
            $_SESSION['usuario'] = $usuario[0];
            if ($usuario[0]['validado'] == 1) {
                header('Location: /tpfinal/lobby/list');
                exit();
            } else {
                $data['usuario'] = $_SESSION['usuario'];
                $this->renderer->render("faltaConfirmarMail", $data);
            }
        }
    }

}