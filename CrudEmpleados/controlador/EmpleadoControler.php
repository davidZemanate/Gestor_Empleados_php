<?php
require_once 'modelo/Empleado.php';

class EmpleadoControler {
    private $empleado;

    public function __construct() {
        $this->empleado = new Empleado();
    }

    public function getAllEmpleados() {
        return $this->empleado->getEmpleadosConDatos();
    }

    public function getAreas() {
        return $this->empleado->getAreas();
    }

    public function getRoles() {
        return $this->empleado->getRoles();
    }
    public function getEmpleadoById($id) {
        return $this->empleado->getEmpleadoById($id);
    }

    // Método para actualizar empleado
    public function updateEmpleado($id, $nombre, $email, $sexo, $area, $descripcion, $boletin, $rol) {
        $query = "UPDATE empleados SET nombre = ?, email = ?, sexo = ?, area_id = ?, descripcion = ?, boletin = ?, rol_id = ? WHERE id = ?";
        $stmt = $this->empleado->prepare($query);

        if ($stmt) {
            $stmt->bind_param("ssssssss", $nombre, $email, $sexo, $area, $descripcion, $boletin, $rol, $id);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        } else {
            die("Error en la preparación de la consulta");
        }
    }
}
?>
