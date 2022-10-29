<?php

require "../app/helper/Enum/EnumUserType.php";

class LoginValidator
{

    public static function loginValidationExistAndActivated($eUserLogin,  $password)
    {
        $userType = new SupportUserType();

        if (!empty($eUserLogin)) {
            error_log("LoginValidator::loginValidationExistAndActivated -> Usuario encontrado en BD!");
            if ($eUserLogin->activo == 1) {
                if (password_verify($password, $eUserLogin->password)) {
                    //si las pass no coinciden
                    error_log("LoginValidator::loginValidationExistAndActivated -> Password coincide en BD!");
                    $nameType = $userType->getTypeUser($eUserLogin->tipo_id);
                    $object = (object) [
                        'usernameExiste' =>  1,
                        'usernameActivo' =>  1,
                        'passCoincide' =>  1,
                        'tipoUsuario' =>  $nameType,
                    ];
                    return $object;
                } else {
                    //si las pass no coinciden
                    error_log("LoginValidator::loginValidationExistAndActivated -> Password no coincide en BD");
                    $object = (object) [
                        'usernameExiste' =>  1,
                        'usernameActivo' =>  1,
                        'passCoincide' =>  0,
                        'tipoUsuario' =>  "",
                    ];
                    return $object;
                }
            } else {
                // usuario existe pero no esta activo
                error_log("LoginValidator::loginValidationExistAndActivated -> Usuario no esta activo en BD");
                $object = (object) [
                    'usernameExiste' =>  1,
                    'usernameActivo' =>  0,
                    'passCoincide' =>  0,
                    'tipoUsuario' =>  "",
                ];
                return $object;
            }
        } else {
            error_log("LoginValidator::loginValidationExistAndActivated -> Usuario no existe en BD ");
            $object = (object) [
                'usernameExiste' =>  0,
                'usernameActivo' =>  0,
                'passCoincide' =>  0,
                'tipoUsuario' =>  "",
            ];
            return $object;
        }
    }
}
