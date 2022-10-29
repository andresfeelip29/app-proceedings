<?php
require "./Repository/IProgramaDependencyRepository.php";

require "../libs/core/BaseConexion.php";

require "./Mapper/ProgramDependencyMapper.php";

class ProgramDependencyDao extends BaseConexion implements IProgramDependencyRepository
{
    function __construct()
    {
        parent::__construct();
    }

    public function save($programDependency)
    {
        $result = false;

        try {
            $query = $this->prepare('INSERT INTO dependencia_programa(nombre) VALUES (:nombre)');
            $query->bindValue('nombre', $programDependency->nombre);
            if ($query->execute()) {
                error_log("ProgramDependencyDao::Save -> Datos guarado con exito!");
                $result = true;
            } else {
                error_log("ProgramDependencyDao::Save -> Erro no se ingresaron los datos!");
            }
        } catch (PDOException $e) {
            error_log("ProgramDependencyDao::Save -> PDOExepcion: " . $e);
        }

        return $result;
    }

    public function getAll()
    {
        $result = null;
        try {
            $query = $this->query('SELECT * FROM dependencia_programa');
            if ($query->execute()) {
                error_log("ProgramDependencyDao::getAll -> Consulta realizada con exito en BD!");
                if ($query->rowCount() > 0) {
                    $p = $query->fetch(PDO::FETCH_ASSOC);
                    $result = ProgramDependencyMapper::ToArrayMap($p);
                    error_log("ProgramDependencyDao::getAll -> Dependenciuas mapeadas con exito!");
                } else {
                    error_log("ProgramDependencyDao::getAll -> No existen depenedencias en BD!");
                }
            } else {
                error_log("ProgramDependencyDao::getAll -> Error al realizar consulta en BD!");
            }
        } catch (PDOException $e) {
            error_log("ProgramDependencyDao::getAll -> PDOExepcion " . $e);
        }
        return $result;
    }

    public function get($id)
    {
        $result = null;
        try {
            $query = $this->prepare('SELECT * FROM dependencia_programa WHERE id = :id ');
            $query->bindValue('id', $id);
            if ($query->execute()) {
                error_log("ProgramDependencyDao::get(id) -> Consulta realizada con exito en BD!");
                if ($query->rowCount() > 0) {
                    $programDependency = $query->fetch(PDO::FETCH_ASSOC);
                    $result = ProgramDependencyMapper::Map(
                        $programDependency["id"],
                        $programDependency["nombre"]
                    );
                    error_log("ProgramDependencyDao::get(id) -> Tipo de usuario existe en BD!");
                } else {
                    error_log("ProgramDependencyDao::get(id) -> Tipo de usuario no existe en BD!");
                    $result = 0;
                }
            } else {
                error_log("ProgramDependencyDao::get(id) -> Error al realizar consulta en BD!");
            }
        } catch (PDOException $e) {
            error_log("ProgramDependencyDao::get(id) -> PDOExepcion" . $e);
        }
        return $result;
    }
    public function delete($id)
    {
        $result = false;
        try {
            $query = $this->prepare('DELETE FROM dependencia_programa WHERE id = :id ');
            $query->bindValue('id', $id);
            if ($query->execute()) {
                error_log("ProgramDependencyDao::Delete(id) -> Datos eliminados con exito en BD!");
                $result = true;
            } else {
                error_log("ProgramDependencyDao::Delete(id) -> No se pudieron eliminaron los datos en BD!");
            }
        } catch (PDOException $e) {
            error_log("ProgramDependencyDao::delete(id) -> PDOExepcion " . $e);
        }
        return $result;
    }
    public function update($programDependency)
    {
        $result = false;
        if (ProgramDependencyDao::get($programDependency->id) != null) {
            try {
                $query = $this->prepare('UPDATE dependencia_programa SET
                nombre = :nombre WHERE id = :id');
                $query->bindValue('nombre', $programDependency->nombre);
                $query->bindValue('id', $programDependency->id);
                if ($query->execute()) {
                    error_log("ProgramDependencyDao::Update -> Datos actualizados con exito en BD!");
                    $result = true;
                } else {
                    error_log("ProgramDependencyDao::Update -> Error no se pudieron actualizar los datos en BD!");
                }
            } catch (PDOException $e) {
                error_log("ProgramDependencyDao::Update -> PDOExepcion: " . $e);
            }
        }
        return $result;
    }
}
