<!DOCTYPE html>
<html>
<head>
    <title>Ejemplo de AJAX sin jQuery</title>
</head>
<body>
<button onclick='sendRequest()'>Realizar solicitud</button>

<script>

    function sendRequest() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://localhost/pregunta.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var pregunta = xhr.responseText
                var responseDiv = document.getElementById('respuesta');
                responseDiv.innerHTML += pregunta + "<br>";
            } else if (xhr.readyState === 4 && xhr.status !== 200) {
                alert("se rompio todo")
            }
        };
        xhr.send();
    }
</script>

<div id='respuesta'></div>
</body>
</html>
