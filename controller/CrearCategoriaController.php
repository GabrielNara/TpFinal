<?php

class CrearCategoriaController
{
    private $renderer;


    public function __construct($renderer,$crearCategoriaModel) {
        $this->renderer = $renderer;
        $this->crearCategoriaModel = $crearCategoriaModel;
    }

    public function list() {
        $this->renderer->render("crearCategoria");
    }

    public function crearCategoria(){
        $datos = array(
            'categoria' => $_POST['categoria'],
        );

        $errores = $this->crearCategoriaModel->validarCreacionCategoria($datos);

        $contexto = array(
            'datos' => $datos,
            'errores' => $errores
        );

        if (!empty($errores)) $this->renderer->render("crearCategoria", $contexto); else $this->renderer->render("confirmarCategoria");

    }
}
