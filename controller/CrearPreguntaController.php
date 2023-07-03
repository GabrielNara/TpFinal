<?php

class CrearPreguntaController
{
    private $renderer;


    public function __construct($renderer,$crearPreguntaModel) {
        $this->renderer = $renderer;
        $this->crearPreguntaModel = $crearPreguntaModel;
    }

    public function list() {
        $datos = $this->crearPreguntaModel->obtenerCategorias();

        $data = array(
            'categorias' => $datos
        );

        $this->renderer->render("crearPregunta", $data);
    }

    public function crearPregunta(){
        $cat = $this->crearPreguntaModel->obtenerCategorias();
        $datos = array(
            'pregunta' => $_POST['pregunta'],
            'opcionA' => $_POST['opcionA'],
            'opcionB' => $_POST['opcionB'],
            'opcionC' => $_POST['opcionC'],
            'opcionD' => $_POST['opcionD'],
            'categoria' => $_POST['categoria'],

        );
        $errores = $this->crearPreguntaModel->validarCreacionPregunta($datos);

        $contexto = array(
            'datos' => $datos,
            'errores' => $errores,
            'categorias' => $cat
        );

        if (!empty($errores)) $this->renderer->render("crearPregunta", $contexto); else $this->renderer->render("confirmarPregunta");

    }
}