<?php
require_once 'configuracion/database.php';

class Empleado {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function getAllEmpleados() {
        $sql = "SELECT * FROM empleados";
        $result = $this->db->query($sql);

        $empleados = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $empleados[] = $row;
            }
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

        // Verifica que cada variable sea del tipo correcto
        $stmt->bind_param('sssisis', $nombre, $email, $sexo, $area, $descripcion, $boletin, $rol);

        if ($stmt->execute()) {
            return true;
        } else {
            // Maneja los errores de SQL
            if ($this->db->errno == 1062) {
                die('El correo electrónico ya existe en la base de datos.');
            } else {
                die('Error al ejecutar la consulta: ' . $stmt->error);
            }
        }

        $stmt->close();
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
