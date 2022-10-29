<?php

require "./Repository/IUserTypeRepository.php";

require "../libs/core/BaseConexion.php";

require "./Mapper/UserTypeMapper.php";

class UserTypeDao extends BaseConexion implements IUserTypeRepository
{
    function __construct()
    {
        parent::__construct();
    }

    public function save($userType)
    {
        $result = false;

        try {
            $query = $this->prepare('INSERT INTO tipo_usuario(nombre) VALUES (:nombre)');
            $query->bindValue('nombre', $userType->nombre);
            if ($query->execute()) {
                error_log("UserTypeDao::Save -> Datos guarado con exito!");
                $result = true;
            } else {
                error_log("UserTypeDao::Save -> Erro no se ingresaron los datos!");
            }
        } catch (PDOException $e) {
            error_log("UserTypeDao::Save -> PDOExepcion: " . $e);
        }

        return $result;
    }

    public function getAll()
    {
        $result = null;

        try {
            $query = $this->query('SELECT * FROM tipo_usuario');
            if ($query->execute()) {
                error_log("UserTypeDao::getAll -> Consulta realizada con exito en BD!");
                if ($query->rowCount() > 0) {
                    $p = $query->fetch(PDO::FETCH_ASSOC);
                    $result = UserTypeMapper::ToArrayMap($p);
                    error_log("UserTypeDao::getAll -> Dependenciuas mapeadas con exito!");
                } else {
                    error_log("UserTypeDao::getAll -> No existen depenedencias en BD!");
                }
            } else {
                error_log("UserTypeDao::getAll -> Error al realizar consulta en BD!");
            }
        } catch (PDOException $e) {
            error_log("UserTypeDao::getAll -> PDOExepcion " . $e);
        }
        return $result;
    }

    public function get($id)
    {
        $result = null;
        try {
            $query = $this->prepare('SELECT * FROM tipo_usuario WHERE id = :id ');
            $query->bindValue('id', $id);
            if ($query->execute()) {
                error_log("UserTypeDao::get(id) -> Consulta realizada con exito en BD!");
                if ($query->rowCount() > 0) {
                    $userType = $query->fetch(PDO::FETCH_ASSOC);
                    $result = UserTypeMapper::Map(
                        $userType["id"],
                        $userType["nombre"]
                    );
                    error_log("UserTypeDao::get(id) -> Tipo de usuario existe en BD!");
                } else {
                    error_log("UserTypeDao::get(id) -> Tipo de usuario no existe en BD!");
                    $result = 0;
                }
            } else {
                error_log("UserTypeDao::get(id) -> Error al realizar consulta en BD!");
            }
        } catch (PDOException $e) {
            error_log("UserTypeDao::get(id) -> PDOExepcion" . $e);
        }
        return $result;
    }
    public function delete($id)
    {
        $result = false;
        try {
            $query = $this->prepare('DELETE FROM tipo_usuario WHERE id = :id ');
            $query->bindValue('id', $id);
            if ($query->execute()) {
                error_log("UserTypeDao::Delete(id) -> Datos eliminados con exito en BD!");
                $result = true;
            } else {
                error_log("UserTypeDao::Delete(id) -> No se pudieron eliminaron los datos en BD!");
            }
        } catch (PDOException $e) {
            error_log("UserTypeDao::delete(id) -> PDOExepcion " . $e);
        }
        return $result;
    }
    public function update($userType)
    {
        $result = false;
        if (UserTypeDao::get($userType->id) != null) {
            try {
                $query = $this->prepare('UPDATE tipo_usuario SET
                nombre = :nombre WHERE id = :id');
                $query->bindValue('nombre', $userType->nombre);
                $query->bindValue('id', $userType->id);
                if ($query->execute()) {
                    error_log("UserTypeDao::Update -> Datos actualizados con exito en BD!");
                    $result = true;
                } else {
                    error_log("UserTypeDao::Update -> Error no se pudieron actualizar los datos en BD!");
                }
            } catch (PDOException $e) {
                error_log("UserTypeDao::Update -> PDOExepcion: " . $e);
            }
        }
        return $result;
    }
}
