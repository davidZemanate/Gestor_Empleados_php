<?php
require_once 'configuracion/database.php';
require_once 'modelo/Empleado.php';

// Crear instancia de la clase Empleado
$empleado = new Empleado();

// Obtener los datos del formulario
$nombre = $_POST['nombre'] ?? '';
$email = $_POST['email'] ?? '';
$sexo = $_POST['sexo'] ?? '';
$areas = $_POST['area'] ?? [];
$descripcion = $_POST['descripcion'] ?? '';
$boletin = isset($_POST['boletin']) ? 1 : 0;
$roles = $_POST['rol'] ?? [];


$errors = [];

// Validar nombre
if (empty($nombre) || !preg_match("/^[a-zA-Z\s]+$/", $nombre)) {
    $errors[] = 'Nombre inválido. Solo se permiten letras y espacios.';
}

// Validar correo electrónico
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Correo electrónico inválido.';
}

// Validar sexo
if (empty($sexo) || !in_array($sexo, ['Masculino', 'Femenino'])) {
    $errors[] = 'Sexo inválido.';
}

// Validar áreas
$validAreas = array_column($empleado->getAreas(), 'id');
$invalidAreas = array_diff($areas, $validAreas);

if (!empty($invalidAreas)) {
    $errors[] = 'Área inválida.';
}

// Validar roles
$validRoles = array_column($empleado->getRoles(), 'id');
$invalidRoles = array_diff($roles, $validRoles);

if (!empty($invalidRoles)) {
    $errors[] = 'Rol inválido.';
}

// Si hay errores, redirigir con mensajes de error
if (!empty($errors)) {
    header('Location: index.php?errors=' . urlencode(implode(', ', $errors)));
    exit;
}

// Llamar al método para agregar el empleado
$resultado = $empleado->addEmpleado($nombre, $email, $sexo, $areas[0], $descripcion, $boletin, $roles[0]);

// Redirigir con mensaje de éxito o error
if ($resultado) {
    header('Location: index.php?success=Empleado agregado exitosamente.');
} else {
    header('Location: index.php?error=Error al agregar el empleado.');
}
?>
