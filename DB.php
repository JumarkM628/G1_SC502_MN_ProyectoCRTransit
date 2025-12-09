<?php
class DB {
    private $host = "localhost";
    private $port = 3307;
    private $user = "root";
    private $pass = "Parrapio2603*";
    private $dbname = "crtransit";
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->dbname,
            $this->port
        );

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function getConexion() {
        return $this->conexion;
    }
}
?>