<?php

class EditorModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function obtenerPreguntasEnRevision()
    {
        $query = "SELECT * FROM `preguntas` WHERE id_estado_pregunta = 3 or id_estado_pregunta = 4";
        return $this->database->query($query);
    }

    public function obtenerPreguntas()
    {
        $query = "SELECT * FROM `preguntas`";
        return $this->database->query($query);
    }


    public function obtenerPregunta($id)
    {
        $query = "SELECT * FROM `preguntas` WHERE  id = '$id'";
        return $this->database->query($query);
    }

    public function validarPreguntaAprobada($datos)
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
            $this->aprobarPregunta($datos);
        }

        return $errores;
    }

    public function aprobarPregunta($datos)
    {
        $id = $datos['id'];
        $pregunta = $datos['pregunta'];
        $opcionA = $datos['opcionA'];
        $opcionB = $datos['opcionB'];
        $opcionC = $datos['opcionC'];
        $opcionD = $datos['opcionD'];
        $categoria = $datos['categoria'];

        $query = "UPDATE `preguntas` SET `pregunta`='$pregunta',`id_estado_pregunta`=1,`id_categoria`='$categoria',`respuesta_a`='$opcionA',`respuesta_b`='$opcionB',`respuesta_c`='$opcionC',`respuesta_d`='$opcionD',`respuesta_correcta`='$opcionA' WHERE id='$id'";

        return $this->database->queryInsertar($query);
    }

    public function eliminarPregunta($idPregunta)
    {
        $query = "DELETE FROM `preguntas` WHERE id = '$idPregunta'";
        $this->database->queryInsertar($query);
    }

}

