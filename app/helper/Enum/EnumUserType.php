<?php

class SupportUserType
{
    const PROFESOR = 1;
    const ADMINISTRATIVO = 2;

    private $typeUser = [];

    public function __construct()
    {
        $this->typeUser = [
            SupportUserType::PROFESOR => "Profesor",
            SupportUserType::ADMINISTRATIVO => "Administrativo"
        ];
    }
    public function getTypeUser($tipo_id)
    {
        return $this->typeUser[$tipo_id];
    }
}
