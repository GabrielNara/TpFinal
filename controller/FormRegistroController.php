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
        $datos = array(
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'username' => $_POST['username'],
            'localidad' => $_POST['localidad'],
            'sexo' => $_POST['sexo'],
            'fnacimiento' => $_POST['fnacimiento'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'cpassword' => $_POST['cpassword'],
            'foto_perfil' => $_FILES['fotoPerfil']['name']
        );

        $errores = $this->formRegistroModel->validarDatosUsuario($datos);

        $contexto = array(
            'datos' => $datos,
            'errores' => $errores
        );

        if (!empty($errores)) $this->renderer->render("formRegistro", $contexto); else $this->renderer->render("confirmarMail", $datos['email']);
    }

    public function validar() {
        $this->formRegistroModel->validarCorreo();
        $this->renderer->render("bienvenida");
    }

    public function confirmarValidacion(){
        $this->formRegistroModel->confirmarValidacion();
    }

    public function confirmarMail(){
        $this->renderer->render("confirmarMail");
    }

}