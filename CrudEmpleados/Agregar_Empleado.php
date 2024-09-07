<?php
// Incluye la configuración de la base de datos y el modelo de Empleado
require_once 'configuracion/database.php';
require_once 'modelo/Empleado.php';

// Crear instancia de la clase Empleado
$empleado = new Empleado();

// Obtener los datos del formulario
$nombre = $_POST['nombre'] ?? '';
$email = $_POST['email'] ?? '';
$sexo = $_POST['sexo'] ?? '';
$area = $_POST['area'] ?? ''; // Asegúrate de que esto es un valor de tipo entero
$descripcion = $_POST['descripcion'] ?? '';
$boletin = isset($_POST['boletin']) ? 1 : 0; // 1 si está marcado, 0 si no
$rol = $_POST['rol'] ?? ''; // Asegúrate de que esto es un valor de tipo entero

// Validar los datos (simple validación; puedes agregar más según sea necesario)
if (empty($nombre) || empty($email) || empty($sexo) || empty($area) || empty($rol)) {
    die('Todos los campos son requeridos.');
}

// Asegúrate de que $area y $rol son enteros
$area = (int)$area;
$rol = (int)$rol;

// Llamar al método para agregar el empleado
$resultado = $empleado->addEmpleado($nombre, $email, $sexo, $area, $descripcion, $boletin, $rol);

// Redirigir según el resultado
if ($resultado) {
    header('Location: index.php?success=Empleado agregado exitosamente.');
} else {
    header('Location: index.php?error=Error al agregar el empleado.');
}
?>
