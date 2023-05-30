<?php

use PHPMailer\PHPMailer\PHPMailer;

class FormRegistroModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function validarDatosUsuario($datos)
    {
        $errores = [];
        if (empty($datos[0])) {
            ////throw new Exception('El campo nombre no puede estar vacío.');
            $errores['errorNombre'] = 'El campo nombre no puede estar vacío.';
        }
        if (empty($datos[1])) {
            //throw new Exception('El campo apellido no puede estar vacío.');
            $errores['errorApellido'] = 'El campo apellido no puede estar vacío.';
        }
        if (empty($datos[2])) {
            //throw new Exception('El campo nombre de usuario no puede estar vacío.');
            $errores['errorUsername'] = 'El campo nombre de usuario no puede estar vacío.';
        }
        $query = "SELECT * FROM usuarios WHERE nombre_usuario = '$datos[2]'";
        $result = $this->database->query($query);
        if (count($result) > 0) {
            //throw new Exception('Ya existe un jugador con ese nombre de usuario.');
            $errores['errorUsername'] = 'Ya existe un jugador con ese nombre de usuario.';
        }
        if (empty($datos[3])) {
            //throw new Exception('El campo país y ciudad no puede estar vacío.');
            $errores['errorPaisCiudad'] = 'El campo país y ciudad no puede estar vacío.';
        }
        if (empty($datos[4])) {
            //throw new Exception('El campo sexo no puede estar vacío.');
            $errores['errorSexo'] = 'El campo sexo no puede estar vacío.';
        }
        if (empty($datos[5])) {
            //throw new Exception('El campo año de nacimiento no puede estar vacío.');
            $errores['errorAnoNacimiento'] = 'El campo año de nacimiento no puede estar vacío.';
        }
        if (empty($datos[6])) {
            //throw new Exception('El campo email no puede estar vacío.');
            $errores['errorEmail'] = 'El campo email no puede estar vacío.';
        }
        $query = "SELECT * FROM usuarios WHERE email = '$datos[6]'";
        $result = $this->database->query($query);
        if (count($result) > 0) {
            //throw new Exception('Ya existe un jugador con ese correo electrónico.');
            $errores['errorEmail'] = 'El campo email no puede estar vacío.';
        }
        if (empty($datos[7])) {
            //throw new Exception('El campo contraseña no puede estar vacío.');
            $errores['errorContrasena'] = 'El campo contraseña no puede estar vacío.';
        }
        if (empty($datos[8])) {
            //throw new Exception('El campo repetir contraseña no puede estar vacío.');
            $errores['errorRepetirContrasena'] = 'El campo repetir contraseña no puede estar vacío.';
        }
        if (empty($datos[9])) {
            //throw new Exception('Debe subir una foto de perfil.');
            $errores['errorFotoPerfil'] = 'Debe subir una foto de perfil.';
        }
        if (!filter_var($datos[6], FILTER_VALIDATE_EMAIL)) {
            //throw new Exception('El email no es válido.');
            $errores['errorEmail'] = 'El email no es válido.';
        }

        if (count($errores) == 0) {
            $this->cargarDatos($datos);
        }

        return $errores;
    }

    public function cargarDatos($datos){
        $nombre = $datos[0];
        $apellido = $datos[1];
        $username = $datos[2];
        $localidad = $datos[3];
        $sexo = $datos[4];
        $anionacimiento = $datos[5];
        $email = $datos[6];
        $contrasena = md5($datos[7]);
        $fotoperfil = $datos[9];
        $token = uniqid();
        $this->moverImagen($fotoperfil);
        $this->enviarEmail($token,$email);

        $query = "INSERT INTO `usuarios`(`nombre`, `apellido`, `email`, `contrasena`, `ano_nacimiento`, `sexo`, `pais_ciudad`, `nombre_usuario`, `foto_perfil`,`token`) 
VALUES ('$nombre','$apellido','$email','$contrasena','$anionacimiento','$sexo','$localidad','$username','$fotoperfil','$token')";
        return $this->database->queryInsertar($query);
    }

    public function enviarEmail($token,$email) {
        $asunto = 'Confirmá tu email para empezar a jugar';
        $cuerpo = "Por favor, haz clic en el siguiente enlace para validar tu correo electrónico: ";
        $cuerpo .= "http://localhost/tpFinal/formregistro/validar?token=$token";

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'juegopreguntastpweb2@gmail.com';
        $mail->Password = 'lwzrhqlwmlewptrc';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('juegopreguntastpweb2@gmail.com');
        $mail->addAddress($email);
        $mail->Subject = $asunto;
        $mail->Body = $cuerpo;
        $mail->send();
    }

    public function validarCorreo() {
        // Obtener el token desde la URL// obtengo el token desde una consulta a la bd

        $token = $_GET['token'];

        $query = "SELECT * FROM usuarios WHERE token = '$token'";
        $result = $this->database->query($query);

        if (!empty($result)) {
            // El token es válido, marcar la cuenta de usuario como validada
            $email = $result[0]['email'];

            // Actualizar la columna de validación en la base de datos
            $query = "UPDATE usuarios SET validado = 1 WHERE email = '$email'";
            $this->database->queryInsertar($query);
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