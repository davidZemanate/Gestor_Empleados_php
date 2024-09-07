<?php
require_once 'modelo/Empleado.php';

class EmpleadoControler {
    private $empleado;

    public function __construct() {
        $this->empleado = new Empleado();
    }

    public function getAllEmpleados() {
        return $this->empleado->getAllEmpleados();
    }

    public function getAreas() {
        return $this->empleado->getAreas();
    }

    public function getRoles() {
        return $this->empleado->getRoles();
    }
}
?>
