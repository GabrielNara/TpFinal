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
        $this->cargarDatos($datos);
    }

    public function cargarDatos($datos){
        $nombre = $datos[0];
        $apellido = $datos[1];
        $username = $datos[2];
        $localidad = $datos[3];
        $sexo = $datos[4];
        $anionacimiento = $datos[5];
        $email = $datos[6];
        $contrasena = $datos[7];
        $fotoperfil = $datos[9];

        $this->moverImagen($fotoperfil);

        $query = "INSERT INTO `usuarios`(`nombre`, `apellido`, `email`, `contrasena`, `ano_nacimiento`, `sexo`, `pais_ciudad`, `nombre_usuario`, `foto_perfil`) 
VALUES ('$nombre','$apellido','$email','$contrasena','$anionacimiento','$sexo','$localidad','$username','$fotoperfil')";
        return $this->database->queryInsertar($query);

    }

    public function moverImagen($fotoperfil){
        $fotoperfil = $_FILES['fotoPerfil']['tmp_name'];

        $rutaImg = 'public/' . $fotoperfil; /*defino la ruta completa del archivo*/
        $infoImg = pathinfo($rutaImg); /*obtengo toda la infromacion de la imaten*/
        $extension = strtolower($infoImg['extension']); /*obtengo la extension*/
        move_uploaded_file($fotoperfil, "./public/" .  $_FILES['fotoPerfil']['name']);
    }

}