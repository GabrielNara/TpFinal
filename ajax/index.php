<!DOCTYPE html>
<html>
<head>
    <title>Ejemplo de AJAX con jQuery</title>
    <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
</head>
<body>
<button onclick='sendRequest()'>Realizar solicitud</button>

<div id='respuesta'></div>

<script>
    function sendRequest() {
        $.ajax({
            url: 'http://localhost/pregunta.php',
            method: 'GET',
            success: function (pregunta) {
                // Manejar la respuesta del backend aquí
                $('#respuesta').append(pregunta + '<br>');
            },
            error: function (xhr, status, error) {
                // Manejar errores aquí
                alert('Se rompió todo');
            }
        });
    }
</script>
</body>
</html>
