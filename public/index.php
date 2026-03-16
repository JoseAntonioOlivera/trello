<?php
require_once __DIR__ . '/../app/TareaController.php';

// Capturamos la acción de la URL, por defecto será 'index'
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Instanciamos el controlador de Tareas
$controller = new TareaController();

// Verificamos si el método existe en la clase TareaController
if (!method_exists($controller, $action)) {
    header("HTTP/1.0 404 Not Found");
    echo "Error: La acción '" . htmlspecialchars($action) . "' no existe en el controlador.";
    exit;
}

// Ejecutamos la acción (index, create, store, edit, update o delete)
$controller->$action();
