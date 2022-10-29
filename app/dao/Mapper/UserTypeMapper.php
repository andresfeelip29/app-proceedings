<?php

class UserTypeMapper
{

    public static function Map(
        $id,
        $nombre
    ) {
        return new UserTypeModel(
            $id,
            $nombre
        );
    }

    public static function ToArrayMap($obj)
    {
        $userTypes = [];
        foreach ($obj as $userType) {
            array_push($userTypes, UserTypeMapper::Map(
                $userType["id"],
                $userType["nombre"]
            ));
        }
        return $userTypes;
    }
}
