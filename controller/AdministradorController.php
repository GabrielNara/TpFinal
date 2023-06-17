<?php


class AdministradorController
{
    private $renderer;

    private $administradorModel;


    public function __construct($renderer, $administradorModel)
    {
        $this->renderer = $renderer;
        $this->administradorModel = $administradorModel;

    }

    public function redireccionamiento() {
        $usuario = $_SESSION['usuario'];
        $rol = $this->administradorModel->getRol($usuario["id"]);

        if ($rol[0]['idRol'] == 3 || $rol[0]['idRol'] == 2 ) {

            header('Location: /tpfinal/lobby/list');
            exit();
        }
    }

    public function estadisticas(){

        $this->redireccionamiento();


        $this->renderer->render("estadisticas");

    }



}