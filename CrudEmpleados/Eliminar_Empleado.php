<?php
// Incluye la configuración de la base de datos y el modelo de Empleado
require_once 'configuracion/database.php';
require_once 'modelo/Empleado.php';

// Crear instancia de la clase Empleado
$empleado = new Empleado();

// Obtener el ID del empleado desde la URL
$id = $_GET['id'] ?? '';

// Validar el ID
if (empty($id) || !is_numeric($id)) {
    die('ID del empleado no válido.');
}

// Llamar al método para eliminar el empleado
$resultado = $empleado->deleteEmpleado((int)$id);

// Redirigir según el resultado
if ($resultado) {
    header('Location: index.php?success=Empleado eliminado exitosamente.');
} else {
    header('Location: index.php?error=Error al eliminar el empleado.');
}
?>
