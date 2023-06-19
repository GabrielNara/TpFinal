<?php

class CrearPreguntaModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function validarCreacionPregunta($datos)
    {
        $errores = [];
        if (empty($datos['pregunta'])) {
            $errores['errorPregunta'] = 'La pregunta no puede estar vacia';
        }
        if (empty($datos['opcionA'])) {
            $errores['errorOpcionA'] = 'Debe ingresar una opcion A';
        }
        if (empty($datos['opcionB'])) {
            $errores['errorOpcionB'] = 'Debe ingresar una opcion B';
        }
        if (empty($datos['opcionC'])) {
            $errores['errorOpcionC'] = 'Debe ingresar una opcion C';
        }
        if (empty($datos['opcionD'])) {
            $errores['errorOpcionD'] = 'Debe ingresar una opcion D';
        }


        if (count($errores) == 0) {
            $this->cargarPregunta($datos);
        }

        return $errores;
    }

    public function cargarPregunta($datos)
    {
        $pregunta = $datos['pregunta'];
        $opcionA = $datos['opcionA'];
        $opcionB = $datos['opcionB'];
        $opcionC = $datos['opcionC'];
        $opcionD = $datos['opcionD'];
        $categoria = $datos['categoria'];


        $query = "INSERT INTO `preguntas`(`pregunta`, `id_estado_pregunta`,`id_categoria`, `respuesta_a`, `respuesta_b`, `respuesta_c`, `respuesta_d`, `respuesta_correcta`)
         VALUES ('$pregunta',4,'$categoria','$opcionA','$opcionB','$opcionC','$opcionD','$opcionA')";
        return $this->database->queryInsertar($query);
    }

}