<?php

include "IRepository.php";

interface ICodeRecoveryRespository extends IRepository
{
    public function getCodeWithCode($code);
    public function updateCodeStatus($id, $codeEstatus);
}
