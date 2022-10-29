<?php



class CodeRecoveryModel
{

    private $id;
    private $id_usuario;
    private $codigo_recuperacion;
    private $estado;

    function __construct($id, $id_usuario, $codigo_recuperacion, $estado)
    {
        $this->id = $id;
        $this->id_usuario = $id_usuario;
        $this->codigo_recuperacion = $codigo_recuperacion;
        $this->estado = $estado;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getId_Usuario()
    {
        return $this->id_usuario;
    }

    public function getCodigo_recuperacion()
    {
        return $this->codigo_recuperacion;
    }

    public function getEstado()
    {
        return $this->estado;
    }
}
