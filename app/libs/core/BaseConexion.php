<?php

include "conexion.php";

class BaseConexion
{
    function __construct()
    {
        $this->db = new Conexion();
    }

    function query($query)
    {
        return $this->db->Connect()->query($query);
    }

    function prepare($query)
    {
        return $this->db->Connect()->prepare($query);
    }
}
