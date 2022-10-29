<?php
class CodeRecoveryMapper
{
    public static function Map(
        $id,
        $id_usuario,
        $codigo_recuperacion,
        $estado
    ) {
        return new CodeRecoveryModel(
            $id,
            $id_usuario,
            $codigo_recuperacion,
            $estado
        );
    }

    public static function ToArrayMap($obj)
    {
        $codeRecoverys = [];
        foreach ($obj as $codeRecovery) {
            array_push($codeRecoverys, CodeRecoveryMapper::Map(
                $codeRecovery["id"],
                $codeRecovery["id_usuario"],
                $codeRecovery["codigo_recuperacion"],
                $codeRecovery["estado"]
            ));
        }
        return $codeRecoverys;
    }
}
