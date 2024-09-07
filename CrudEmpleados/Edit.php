<?php
require_once 'configuracion/sql.php';
require_once 'controlador/EmpleadoControler.php';

$controller = new EmpleadoControler();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $empleado = $controller->getEmpleadoById($id); // Asegúrate de implementar este método en EmpleadoControler

    if (!$empleado) {
        die('Empleado no encontrado');
    }
} else {
    die('ID de empleado no especificado');
}

$areas = $controller->getAreas();
$roles = $controller->getRoles();


$empleado['area_id'] = isset($empleado['area_id']) && is_array($empleado['area_id']) ? $empleado['area_id'] : [];
$empleado['rol_id'] = isset($empleado['rol_id']) && is_array($empleado['rol_id']) ? $empleado['rol_id'] : [];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Incluir FontAwesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <header class="bg-primary text-white text-center p-3">
        <h1>Editar Empleado</h1>
    </header>
    <a href="index.php" class="btn btn-success">
        <i class="fas fa-users"></i> Empleados
    </a>
    <div class="container mt-4" style="min-height: 440px;">
        <form id="editEmployeeForm" method="post" action="Actualizar_Empleado.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($empleado['id']); ?>">
            <div class="form-group">
                <label for="nombre">Nombre Completo</label>
                <input type="text" class="form-control" required id="nombre" name="nombre" value="<?php echo htmlspecialchars($empleado['nombre']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" class="form-control" required id="email" name="email" value="<?php echo htmlspecialchars($empleado['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="sexo">Sexo</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="sexo_masculino" name="sexo" value="Masculino" <?php if ($empleado['sexo'] == 'Masculino') echo 'checked'; ?>>
                    <label class="form-check-label" for="sexo_masculino">Masculino</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" id="sexo_femenino" name="sexo" value="Femenino" <?php if ($empleado['sexo'] == 'Femenino') echo 'checked'; ?>>
                    <label class="form-check-label" for="sexo_femenino">Femenino</label>
                </div>
            </div>
            <div class="form-group">
                <label for="area">Área</label>
                <?php foreach ($areas as $area): ?>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="area_<?php echo $area['id']; ?>" name="area[]" value="<?php echo $area['id']; ?>" <?php if (in_array($area['id'], $empleado['area_id'])) echo 'checked'; ?>>
                        <label class="form-check-label" for="area_<?php echo $area['id']; ?>"><?php echo $area['nombre']; ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?php echo htmlspecialchars($empleado['descripcion']); ?></textarea>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="boletin" name="boletin" <?php if ($empleado['boletin']) echo 'checked'; ?>>
                <label class="form-check-label" for="boletin">Quiero recibir boletín</label>
            </div>
            <div class="form-group">
                <label for="rol">Rol</label>
                <?php foreach ($roles as $rol): ?>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="rol_<?php echo $rol['id']; ?>" name="rol[]" value="<?php echo $rol['id']; ?>" <?php if (in_array($rol['id'], $empleado['rol_id'])) echo 'checked'; ?>>
                        <label class="form-check-label" for="rol_<?php echo $rol['id']; ?>"><?php echo $rol['nombre']; ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>

    <footer class="bg-dark text-white text-center p-3 mt-4">
        <p>&copy; <?php echo date("Y"); ?> Desarrollo en PHP. Desarrollado por David Fernando Zemanate.</p>
    </footer>

    <!-- Incluir jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>
    <script src="asstes/js/validacion.js"></script>
</body>

</html>
