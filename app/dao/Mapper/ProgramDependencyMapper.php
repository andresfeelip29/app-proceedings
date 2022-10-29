<?php



class ProgramDependencyMapper
{

    public static function Map(
        $id,
        $nombre
    ) {
        return new ProgramDependencyModel(
            $id,
            $nombre
        );
    }

    public static function ToArrayMap($obj)
    {
        $programDependencys = [];
        foreach ($obj as $programDependency) {
            array_push($programDependencys, ProgramDependencyMapper::Map(
                $programDependency["id"],
                $programDependency["nombre"]
            ));
        }
        return $programDependencys;
    }
}
