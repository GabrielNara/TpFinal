<?php

// Inicializar una sesión cURL
$ch = curl_init();

// Establecer la URL y otras opciones
curl_setopt($ch, CURLOPT_URL, 'localhost/pregunta.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecutar la solicitud y obtener la respuesta
$response = curl_exec($ch);

// Verificar si ocurrió algún error
if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
    // Manejar el error aquí
}

// Cerrar la sesión cURL
curl_close($ch);

// Trabajar con la respuesta
echo "Le pegamos a otra api y nos dio -> " . var_dump(json_decode($response));
?>