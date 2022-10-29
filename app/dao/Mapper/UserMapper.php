<?php

class UserMapper
{

    public static function Map(
        $id,
        $tipo_id,
        $programa_dependencia_id,
        $identificacion,
        $nombres,
        $apellidos,
        $email,
        $username,
        $password,
        $activo,
        $hash
    ) {
        return new UserModel(
            $id,
            $tipo_id,
            $programa_dependencia_id,
            $identificacion,
            $nombres,
            $apellidos,
            $email,
            $username,
            $password,
            $activo,
            $hash
        );
    }

    public static function ToArrayMap($obj)
    {
        $users = [];
        foreach ($obj as $user) {
            array_push($users, UserMapper::Map(
                $user["id"],
                $user["tipo_id"],
                $user["programa_dependencia_id"],
                $user["identificacion"],
                $user["nombres"],
                $user["apellidos"],
                $user["email"],
                $user["username"],
                $user["password"],
                $user["activo"],
                $user["hash"],
            ));
        }
        return $users;
    }

    public static function eUserMap(
        $id,
        $username
    ) {
        return new eUserModel(
            $id,
            $username
        );
    }

    public static function eLoginUserMap(
        $id,
        $tipo_id,
        $username,
        $password,
        $activo
    ) {
        return new eLoginUserModel(
            $id,
            $tipo_id,
            $username,
            $password,
            $activo
        );
    }
}
