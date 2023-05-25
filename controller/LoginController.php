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
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $username = $_POST['username'];
        $localidad = $_POST['localidad'];
        $sexo = $_POST['sexo'];
        $fnacimiento = $_POST['fnacimiento'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $foto_perfil = $_FILES['fotoPerfil'];
        $datos = array($nombre, $apellido, $username, $localidad, $sexo, $fnacimiento, $email, $password, $cpassword, $foto_perfil);
        $this->formRegistroModel->registrarUsuario($datos);
    }

}