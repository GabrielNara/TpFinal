<?php

class FormRegistroModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function registrarUsuario($datos)
    {
        if (empty($datos[0])) throw new Exception('El campo nombre no puede estar vacío.');
        if (empty($datos[1])) throw new Exception('El campo apellido no puede estar vacío.');
        if (empty($datos[2])) throw new Exception('El campo username no puede estar vacío.');
        if (empty($datos[3])) throw new Exception('El campo país y ciudad no puede estar vacío.');
        if (empty($datos[4])) throw new Exception('El campo sexo no puede estar vacío.');
        if (empty($datos[5])) throw new Exception('El campo año de nacimiento no puede estar vacío.');
        if (empty($datos[6])) throw new Exception('El campo email no puede estar vacío.');
        if (empty($datos[7])) throw new Exception('El campo contraseña no puede estar vacío.');
        if (empty($datos[8])) throw new Exception('El campo repetir contraseña no puede estar vacío.');
        if (empty($datos[9])) throw new Exception('Debe subir una foto de perfil.');
        if (!filter_var($datos[6], FILTER_VALIDATE_EMAIL)) throw new Exception('El email no es válido.');
    }
}