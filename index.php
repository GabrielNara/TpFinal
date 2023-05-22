<?php
/*include_once('Configuration.php');
$configuration = new Configuration();
$router = $configuration->getRouter();

$module = $_GET['module'] ?? 'lobby';
$method = $_GET['action'] ?? 'list';

$router->route($module, $method); */


include_once('Configuration.php');
$configuration = new Configuration();
$router = $configuration->getRouter();

$module = $_GET['module'] ?? 'lobby';
$method = $_GET['action'] ?? 'list';

$baseUrl = $configuration->getBaseUrl();
$module = str_replace('/TpFinal', '', $module); // Remueve el prefijo '/TpFinal' del módulo

// Reconstruye la URL con el prefijo '/TpFinal'
$_GET['module'] = $module !== 'lobby' ? '/TpFinal/' . $module : 'lobby';

$router->route($module, $method);

