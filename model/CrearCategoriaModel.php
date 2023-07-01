<?php

class CrearCategoriaModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function validarCreacionCategoria($datos)
    {
        $errores = [];
        if (empty($datos['categoria'])) {
            $errores['errorCategoria'] = 'La categoria no puede estar vacia';
        }

        if (count($errores) == 0) {
            $this->cargarCategoria($datos);
        }

        return $errores;
    }

    public function cargarCategoria($datos)
    {

        $categoria = $datos['categoria'];

        $query = "INSERT INTO `categorias`(`categoria`)
         VALUES ('$categoria')";

        return $this->database->queryInsertar($query);
    }

}