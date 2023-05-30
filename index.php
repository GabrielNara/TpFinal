<?php
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
}
include_once('Configuration.php');
$configuration = new Configuration();
$router = $configuration->getRouter();

$module = $_GET['module'] ?? 'home';
$method = $_GET['action'] ?? 'list';

$baseUrl = $configuration->getBaseUrl();
$module = str_replace('/TpFinal', '', $module); // Remueve el prefijo '/TpFinal' del módulo

// Reconstruye la URL con el prefijo '/TpFinal'
$_GET['module'] = $module !== 'home' ? '/TpFinal/' . $module : 'home';

$router->route($module, $method);

