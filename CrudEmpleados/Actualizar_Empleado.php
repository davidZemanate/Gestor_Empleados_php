<?php
require_once 'configuracion/sql.php';
require_once 'controlador/EmpleadoControler.php';

$controller = new EmpleadoControler();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $sexo = $_POST['sexo'];
    $descripcion = $_POST['descripcion'];
    $boletin = isset($_POST['boletin']) ? 1 : 0;

    // Obtén las áreas y roles seleccionados como arrays
    $areas = isset($_POST['area']) ? $_POST['area'] : [];
    $roles = isset($_POST['rol']) ? $_POST['rol'] : [];

    // Convierte los arrays a cadenas separadas por comas
    $area = implode(',', $areas);
    $rol = implode(',', $roles);

    // Actualiza el empleado
    if ($controller->updateEmpleado($id, $nombre, $email, $sexo, $area, $descripcion, $boletin, $rol)) {
        header('Location: index.php?success=Empleado Actualizado exitosamente.'); // Redirige a una página de éxito
        exit;
    } else {
        header('Location: index.php?success=Empleado Actualizado exitosamente.');
    }
} else {
    die('Método no permitido');
}
