<?php

class UserModel
{
    private $id;
    private $tipo_id;
    private $programa_dependencia_id;
    private $identificacion;
    private $nombres;
    private $apellidos;
    private $email;
    private $username;
    private $password;
    private $activo;
    private $hash;

    function __construct($id, $tipo_id, $programa_dependencia_id, $identificacion, $nombres, $apellidos, $email, $username, $password, $activo, $hash)
    {
        $this->id = $id;
        $this->tipo_id = $tipo_id;
        $this->programa_dependencia_id = $programa_dependencia_id;
        $this->identificacion = $identificacion;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->activo = $activo;
        $this->hash = $hash;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getTipo_Id()
    {
        return $this->tipo_id;
    }
    public function getPrograma_dependencia_Id()
    {
        return $this->programa_dependencia_id;
    }
    public function getIdentificacion()
    {
        return $this->identificacion;
    }
    public function getNombres()
    {
        return $this->nombres;
    }
    public function getApellidos()
    {
        return $this->apellidos;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getActivo()
    {
        return $this->activo;
    }
    public function getHash()
    {
        return $this->hash;
    }
}
