<?php

interface ICodeRecoveryService
{
    public function recoveryPassword($username, $email);
    public function updatePassword($id, $password);
    public function validateCode($code);
}
