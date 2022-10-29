<?php
require_once('../config/config.php');

class Conexion
{
    private $servidor;
    private $usuario;
    private $contrasena;
    private $basedatos;
    public  $conexion;

    public function __construct()
    {
        $this->servidor   = constant('HOST');
        $this->usuario      = constant('USER');
        $this->contrasena = constant('PASSWORD');
        $this->basedatos  = constant('DB');
    }

    function Connect()
    {
        try {
            $this->conexion = new PDO("mysql:host=$this->servidor;dbname=$this->basedatos", "$this->usuario", "$this->contrasena");
            error_log('Conexión a BD exitosa');
        } catch (PDOException $e) {
            error_log('Error en conexion BD :: ' . $e->getMessage());
        }
    }

    function Close()
    {
        $this->conexion->close();
    }
}
