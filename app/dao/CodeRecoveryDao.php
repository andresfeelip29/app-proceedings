<?php
require "./Repository/ICodeRecoveryRepository.php";

require "../libs/core/BaseConexion.php";

require "./Mapper/CodeRecoveryMapper.php";

class CodeRecoveryDao extends BaseConexion implements ICodeRecoveryRespository
{
    function __construct()
    {
        parent::__construct();
    }

    public function save($codeRecovery)
    {
        $result = false;

        try {
            $query = $this->prepare('INSERT INTO cod_recuperacion(
            id_usuario,
            codigo_recuperacion,
            estado) VALUES (:id_usuario, :codigo_recuperacion,:estado)');
            $query->bindValue('tipo_id', $codeRecovery->id_usuario);
            $query->bindValue('programa_dependencia_id', $codeRecovery->codigo_recuperacion);
            $query->bindValue('identificacion', $codeRecovery->estado);
            if ($query->execute()) {
                error_log("CodeRecoveryDao::Save -> Datos guarado con exito!");
                $result = true;
            } else {
                error_log("CodeRecoveryDao::Save -> Erro no se ingresaron los datos!");
            }
        } catch (PDOException $e) {
            error_log("CodeRecoveryDao::Save -> PDOExepcion: " . $e);
        }

        return $result;
    }

    public function getAll()
    {
        $result = null;

        try {
            $query = $this->query('SELECT * FROM cod_recuperacion');
            $p = $query->fetch(PDO::FETCH_ASSOC);
            $result = CodeRecoveryMapper::ToArrayMap($p);
            error_log("CodeRecoveryDao::getAll -> Datos consultados cone exito!");
        } catch (PDOException $e) {
            error_log("CodeRecoveryDao::getAll -> PDOExepcion " . $e);
        }

        return $result;
    }

    public function get($id)
    {
        $result = null;
        try {
            $query = $this->prepare('SELECT * FROM cod_recuperacion WHERE id = :id');
            $query->bindValue('id', $id);
            if ($query->execute()) {
                error_log("CodeRecoveryDao::get(id) -> Consulta realizada con exito en BD!");
                if ($query->rowCount() > 0) {
                    $codeRecovery = $query->fetch(PDO::FETCH_ASSOC);
                    $result = CodeRecoveryMapper::Map(
                        $codeRecovery["id"],
                        $codeRecovery["id_usuario"],
                        $codeRecovery["codigo_recuperacion"],
                        $codeRecovery["estado"]
                    );
                    error_log("CodeRecoveryDao::get(id) -> Usuario existe en BD!");
                } else {
                    error_log("CodeRecoveryDao::get(id) -> Usuario no existe en BD!");
                    $result = 0;
                }
            } else {
                error_log("CodeRecoveryDao::get(id) -> Error al realizar consulta en BD!");
            }
        } catch (PDOException $e) {
            error_log("CodeRecoveryDao::get(id) -> PDOExepcion" . $e);
        }
        return $result;
    }
    public function delete($id)
    {
        $result = false;
        try {
            $query = $this->prepare('DELETE FROM cod_recuperacion WHERE id = :id');
            $query->bindValue('id', $id);
            if ($query->execute()) {
                error_log("CodeRecoveryDao::Delete(id) -> Datos eliminados con exito en BD!");
                $result = true;
            } else {
                error_log("CodeRecoveryDao::Delete(id) -> No se pudieron eliminaron los datos en BD!");
            }
        } catch (PDOException $e) {
            error_log("CodeRecoveryDao::delete(id) -> PDOExepcion " . $e);
        }
        return $result;
    }
    public function update($codeRecovery)
    {
        $result = false;

        if (CodeRecoveryDao::get($codeRecovery->id) != null) {
            try {
                $query = $this->prepare('UPDATE cod_recuperacion SET
                id_usuario = :id_usuario,
                codigo_recuperacion = :codigo_recuperacion,
                estado = :estado WHERE id = :id');
                $query->bindValue('id', $codeRecovery->id);
                $query->bindValue('tipo_id', $codeRecovery->id_usuario);
                $query->bindValue('programa_dependencia_id', $codeRecovery->codigo_recuperacion);
                $query->bindValue('estado', $codeRecovery->estado);
                if ($query->execute()) {
                    error_log("CodeRecoveryDao::Update -> Datos actualizados con exito en BD!");
                    $result = true;
                } else {
                    error_log("CodeRecoveryDao::Update -> Error no se pudieron actualizar los datos en BD!");
                }
            } catch (PDOException $e) {
                error_log("CodeRecoveryDao::Update -> PDOExepcion: " . $e);
            }
        }
        return $result;
    }

    public function getCodeWithCode($code)
    {
        $object = null;

        try {
            $query = $this->prepare("SELECT * FROM `cod_recuperacion` WHERE codigo_recuperacion = :code");
            $query->bindValue(':code', $code);

            if ($query->execute()) {
                error_log("CodeRecoveryDao::getCodeWithCode -> Consulta realizada con exito en BD!");

                if ($query->rowCount() > 0) {

                    $result = $query->fetch(PDO::FETCH_ASSOC);

                    $code = CodeRecoveryMapper::Map(
                        $result["id"],
                        $result["id_usuario"],
                        $result["codigo_recuperacion"],
                        $result["estado"]
                    );

                    $object = (object) [
                        'id_codigo' => $code->id,
                        'existe' => 1,
                        'estado' => $code->estado,
                        'id_usuario' => $code->id_usuario
                    ];
                    error_log("CodeRecoveryDao::getCodeWithCode -> Usuario existe en BD!");
                } else {
                    $object = (object) [
                        'id_codigo' => 0,
                        'existe' => 0,
                        'estado' => 0,
                        'id_usuario' => 0
                    ];
                    error_log("CodeRecoveryDao::getCodeWithCode -> codigo no existe en BD!");
                }
            } else {
                error_log("CodeRecoveryDao::getCodeWithCode -> Error al realizar consulta en BD!");
            }
        } catch (PDOException $e) {
            error_log("CodeRecoveryDao::getCodeWithCode ->  -> PDOExepcion:" . $e);
        }
        return $object;
    }

    public function updateCodeStatus($id, $codeEstatus)
    {
        $result = false;

        if (CodeRecoveryDao::get($id) != null) {
            try {
                $query = $this->prepare('UPDATE cod_recuperacion SET estado = :estado WHERE id = :id');
                $query->bindValue('id', $id);
                $query->bindValue('estado', $codeEstatus);
                if ($query->execute()) {
                    error_log("CodeRecoveryDao::updateCodeStatus -> Datos actualizados con exito en BD!");
                    $result = true;
                } else {
                    error_log("CodeRecoveryDao::updateCodeStatus -> Error no se pudieron actualizar los datos en BD!");
                }
            } catch (PDOException $e) {
                error_log("CodeRecoveryDao::updateCodeStatus -> PDOExepcion: " . $e);
            }
        }
        return $result;
    }
}
