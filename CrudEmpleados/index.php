<?php
// Incluye el controlador
require_once 'controlador/EmpleadoControler.php';

// Crear instancia del controlador
$controller = new EmpleadoControler();

// Obtener todos los empleados, áreas y roles
$empleados = $controller->getAllEmpleados();
$areas = $controller->getAreas();
$roles = $controller->getRoles();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empleados</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Incluir FontAwesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <header class="bg-primary text-white text-center p-3">
        <h1>Gestión de Empleados</h1>
    </header>

    <div class="container mt-4">
        <!-- Botón para abrir el modal -->
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addEmployeeModal">
            <i class="fas fa-plus"></i> Agregar Empleado
        </button>

        <!-- Tabla de empleados -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo Electrónico</th>
                    <th>Sexo</th>
                    <th>Área</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empleados as $emp): ?>
                <tr>
                    <td><?php echo htmlspecialchars($emp['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($emp['email']); ?></td>
                    <td><?php echo htmlspecialchars($emp['sexo']); ?></td>
                    <td><?php echo htmlspecialchars($emp['area_id']); ?></td>
                    <td><?php echo htmlspecialchars($emp['rol_id']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $emp['id']; ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="Eliminar_Empleado.php?id=<?php echo $emp['id']; ?>" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Eliminar
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para agregar empleado -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Agregar Empleado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addEmployeeForm" method="post" action="Agregar_Empleado.php">
                        <div class="form-group">
                            <label for="nombre">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="sexo">Sexo</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="sexo_masculino" name="sexo[]" value="Masculino">
                                <label class="form-check-label" for="sexo_masculino">Masculino</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="sexo_femenino" name="sexo[]" value="Femenino">
                                <label class="form-check-label" for="sexo_femenino">Femenino</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="area">Área</label>
                            <?php foreach ($areas as $area): ?>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="area_<?php echo $area['id']; ?>" name="area[]" value="<?php echo $area['id']; ?>">
                                    <label class="form-check-label" for="area_<?php echo $area['id']; ?>"><?php echo $area['nombre']; ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="boletin" name="boletin">
                            <label class="form-check-label" for="boletin">Quiero recibir boletín</label>
                        </div>
                        <div class="form-group">
                            <label for="rol">Rol</label>
                            <?php foreach ($roles as $rol): ?>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="rol_<?php echo $rol['id']; ?>" name="rol[]" value="<?php echo $rol['id']; ?>">
                                    <label class="form-check-label" for="rol_<?php echo $rol['id']; ?>"><?php echo $rol['nombre']; ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
   

    <footer class="bg-dark text-white text-center p-3 mt-4">
        <p>&copy; <?php echo date("Y"); ?> Tu Empresa. Todos los derechos reservados.</p>
    </footer>

    <!-- Incluir jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Estilos personalizados -->
    <script src="js/script.js"></script>
</body>
</html>
