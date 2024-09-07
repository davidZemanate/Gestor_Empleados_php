<?php
require_once 'configuracion/database.php';

class Empleado {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function getEmpleadosConDatos() {
        $query = "
            SELECT e.id, e.nombre, e.email, e.sexo, a.nombre AS area_nombre, r.nombre AS rol_nombre
            FROM empleados e
            LEFT JOIN areas a ON e.area_id = a.id
            LEFT JOIN roles r ON e.rol_id = r.id
        ";

        $result = $this->db->query($query);

        $empleados = [];
        while ($row = $result->fetch_assoc()) {
            $empleados[] = $row;
        }

        return $empleados;
    }


    public function getAreas() {
        $sql = "SELECT * FROM areas";
        $result = $this->db->query($sql);

        $areas = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $areas[] = $row;
            }
        }
        return $areas;
    }

    public function getRoles() {
        $sql = "SELECT * FROM roles";
        $result = $this->db->query($sql);

        $roles = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $roles[] = $row;
            }
        }
        return $roles;
    }

    public function addEmpleado($nombre, $email, $sexo, $area, $descripcion, $boletin, $rol) {
        $sql = "INSERT INTO empleados (nombre, email, sexo, area_id, descripcion, boletin, rol_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
    
        if (!$stmt) {
            die('Error en la preparación de la consulta: ' . $this->db->error);
        }
    
        // Los tipos de datos en bind_param deben coincidir con el SQL
        $stmt->bind_param('sssiisi', $nombre, $email, $sexo, $area, $descripcion, $boletin, $rol);
    
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            // Maneja los errores de SQL
            if ($this->db->errno == 1062) {
                die('El correo electrónico ya existe en la base de datos.');
            } else {
                die('Error al ejecutar la consulta: ' . $stmt->error);
            }
        }
    }

    public function deleteEmpleado($id) {
        $sql = "DELETE FROM empleados WHERE id = ?";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            die('Error en la preparación de la consulta: ' . $this->db->error);
        }

        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            return true;
        } else {
            die('Error al ejecutar la consulta: ' . $stmt->error);
        }

        $stmt->close();
    }
}
?>
