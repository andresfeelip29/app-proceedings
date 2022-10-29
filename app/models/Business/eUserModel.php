<?php

class eUserModel
{
    private $id;
    private $username;

    function __construct($id, $username)
    {
        $this->id = $id;
        $this->username = $username;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }
}

class eLoginUserModel
{
    private $id;
    private $tipo_id;
    private $username;
    private $password;
    private $activo;

    function __construct($id, $tipo_id, $username, $password, $activo)
    {
        $this->id = $id;
        $this->tipo_id = $tipo_id;
        $this->username = $username;
        $this->password = $password;
        $this->activo = $activo;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getTipo_Id()
    {
        return $this->tipo_id;
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
}
