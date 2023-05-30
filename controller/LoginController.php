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
        $nombre_usuario = $_POST['username'];
        $contrasena = $_POST['password'];

        $usuario = $this->usuarioModel->getUsuario($nombre_usuario, $contrasena);

        if (empty($usuario)) {
            $errores = $this->usuarioModel->getErrores($nombre_usuario, $contrasena);
            $this->renderer->render("login", $errores);
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