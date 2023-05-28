<?php
include_once('./model/FormRegistroModel.php');

class FormRegistroController
{
    private $renderer;
    private $formRegistroModel;

    public function __construct($renderer, $formRegistroModel)
    {
        $this->renderer = $renderer;
        $this->formRegistroModel = $formRegistroModel;
    }

    public function list()
    {
        $this->renderer->render("formRegistro");
    }

    public function registrar()
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
        $foto_perfil = $_FILES['fotoPerfil']['name'];
        $datos = array($nombre, $apellido, $username, $localidad, $sexo, $fnacimiento, $email, $password, $cpassword, $foto_perfil);
        $this->formRegistroModel->registrarUsuario($datos);
    }

}