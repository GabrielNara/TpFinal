<?php
//API REST
$pregunta =  ["id"=>1,
    "pregunta"=> "Cuantos huevos hay en una docena",
    "respuestas" => [ "3", "200", "12", "5"],
    "respuesta_correcta" => 2];

echo json_encode($pregunta);