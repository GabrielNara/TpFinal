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
        $token = uniqid();
        $this->enviarEmail($token,$email);
        $this->moverImagen($fotoperfil);

        $query = "INSERT INTO `usuarios`(`nombre`, `apellido`, `email`, `contrasena`, `ano_nacimiento`, `sexo`, `pais_ciudad`, `nombre_usuario`, `foto_perfil`,`token`) 
VALUES ('$nombre','$apellido','$email','$contrasena','$anionacimiento','$sexo','$localidad','$username','$fotoperfil','$token')";
        return $this->database->queryInsertar($query);

    }

    public function enviarEmail($token,$email) {

      $subject = "Validación de correo electrónico";
      $message = "Por favor, haz clic en el siguiente enlace para validar tu correo electrónico: ";
      $message .= "http://localhost:8080/tpFinal/formregistro/validar?token=$token";
      $headers = "From: http://localhost:8080/tpFinal/";

      mail($email, $subject, $message, $headers);
    }

    public function validarCorreo() {
        // Obtener el token desde la URL
        $token = $_GET['token'];

        $query = "SELECT * FROM usuarios WHERE token = '$token'";
        $result = $this->database->query($query);
        

        if (!empty($result)) {
            // El token es válido, marcar la cuenta de usuario como validada

            $email = $result[0]['email'];

            // Actualizar la columna de validación en la base de datos
            $query = "UPDATE usuarios SET validado = 1 WHERE email = '$email'";
            $this->database->queryInsertar($query);

            // Mostrar un mensaje de éxito o redirigir al usuario a una página de éxito
            echo "¡Tu correo electrónico ha sido validado con éxito!";
        } else {
            // El token no es válido
            echo "El token de validación no es válido.";
        }


    }

    public function moverImagen($fotoperfil){
        $fotoperfil = $_FILES['fotoPerfil']['tmp_name'];

        $rutaImg = 'public/' . $fotoperfil; /*defino la ruta completa del archivo*/
        $infoImg = pathinfo($rutaImg); /*obtengo toda la infromacion de la imaten*/
        $extension = strtolower($infoImg['extension']); /*obtengo la extension*/
        move_uploaded_file($fotoperfil, "./public/" .  $_FILES['fotoPerfil']['name']);
    }

}