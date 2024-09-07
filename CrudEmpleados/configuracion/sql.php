<?php
require_once 'database.php';

class Inicializador {
    private $conexion;

    public function __construct() {
        $db = new Database();
        $this->conexion = $db->getConnection();
    }

    public function inicializarTablas() {
        $queries = [
            "CREATE TABLE IF NOT EXISTS roles (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(100) NOT NULL
            )",
            "CREATE TABLE IF NOT EXISTS areas (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(100) NOT NULL
            )",
            "CREATE TABLE IF NOT EXISTS empleados (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL,
                sexo ENUM('Masculino', 'Femenino') NOT NULL,
                boletin TINYINT(1) DEFAULT 0,
                descripcion TEXT,
                area_id INT,
                rol_id INT,
                FOREIGN KEY (area_id) REFERENCES areas(id),
                FOREIGN KEY (rol_id) REFERENCES roles(id)
            )",
            "CREATE TABLE IF NOT EXISTS empleado_rol (
                id INT AUTO_INCREMENT PRIMARY KEY,
                empleado_id INT,
                rol_id INT,
                FOREIGN KEY (empleado_id) REFERENCES empleados(id),
                FOREIGN KEY (rol_id) REFERENCES roles(id)
            )"
        ];

        foreach ($queries as $query) {
            $resultado = $this->conexion->query($query);
            if (!$resultado) {
                die("Error al crear tablas: " . $this->conexion->error);
            }
        }

        // Insertar datos iniciales en las tablas si están vacías
        $this->insertarDatosIniciales();
    }

    private function insertarDatosIniciales() {
        // Insertar datos en la tabla áreas solo si está vacía
        $checkAreasQuery = "SELECT COUNT(*) as count FROM areas";
        $result = $this->conexion->query($checkAreasQuery);
        $row = $result->fetch_assoc();
        if ($row['count'] == 0) {
            $areas = [
                "INSERT INTO areas (nombre) VALUES ('Ventas')",
                "INSERT INTO areas (nombre) VALUES ('Calidad')",
                "INSERT INTO areas (nombre) VALUES ('Producción')"
            ];

            foreach ($areas as $insertArea) {
                $this->conexion->query($insertArea);
            }
        }

        // Insertar datos en la tabla roles solo si está vacía
        $checkRolesQuery = "SELECT COUNT(*) as count FROM roles";
        $result = $this->conexion->query($checkRolesQuery);
        $row = $result->fetch_assoc();
        if ($row['count'] == 0) {
            $roles = [
                "INSERT INTO roles (nombre) VALUES ('Profesional de Proyectos - Desarrollador')",
                "INSERT INTO roles (nombre) VALUES ('Gerente Estratégico')",
                "INSERT INTO roles (nombre) VALUES ('Auxiliar Administrativo')"
            ];

            foreach ($roles as $insertRol) {
                $this->conexion->query($insertRol);
            }
        }
    }
}

// Ejecutar la inicialización
$inicializador = new Inicializador();
$inicializador->inicializarTablas();
?>
