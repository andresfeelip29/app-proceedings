<?php

require "./Repository/IUserRepository.php";

require "../libs/core/BaseConexion.php";

require "./Mapper/UserMapper.php";

class UserDao extends BaseConexion implements IUserRepository
{

    function __construct()
    {
        parent::__construct();
    }

    public function save($user)
    {
        $result = false;

        try {
            $query = $this->prepare('INSERT INTO usuarios(
            tipo_id,
            programa_dependencia_id,
            identificacion,
            nombres,
            apellidos,
            email,
            username,
            password,
            activo,
            hash) VALUES (:tipo_id, :programa_dependencia_id,:identificacion, :nombres ,:apellidos,:email,:username, :password, :activo,:hash)');
            $query->bindValue('tipo_id', $user->tipo_id);
            $query->bindValue('programa_dependencia_id', $user->programa_dependencia_id);
            $query->bindValue('identificacion', $user->identificacion);
            $query->bindValue('nombres', $user->nombres);
            $query->bindValue('email', $user->apellidos);
            $query->bindValue('apellidos', $user->email);
            $query->bindValue('email', $user->username);
            $query->bindValue('password', $user->password);
            $query->bindValue('activo', $user->activo);
            $query->bindValue('hash', $user->hash);
            if ($query->execute()) {
                error_log("UserDao::Save -> Datos guarado con exito!");
                $result = true;
            } else {
                error_log("UserDao::Save -> Error no se ingresaron los datos!");
            }
        } catch (PDOException $e) {
            error_log("UserDao::Save -> PDOExepcion: " . $e);
        }

        return $result;
    }

    public function getAll()
    {
        $result = null;

        try {
            $query = $this->query('SELECT * FROM usuarios');
            $p = $query->fetch(PDO::FETCH_ASSOC);
            $result = UserMapper::ToArrayMap($p);
            error_log("UserDao::getAll -> Datos consultados cone exito!");
        } catch (PDOException $e) {
            error_log("UserDao::getAll -> PDOExepcion " . $e);
        }

        return $result;
    }

    public function get($id)
    {
        $result = null;
        try {
            $query = $this->prepare('SELECT * FROM usuarios WHERE id = :id ');
            $query->bindValue('id', $id);
            if ($query->execute()) {
                error_log("UserDao::get(id) -> Consulta realizada con exito en BD!");
                if ($query->rowCount() > 0) {
                    $user = $query->fetch(PDO::FETCH_ASSOC);
                    $result = UserMapper::Map(
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
                        $user["hash"]
                    );
                    error_log("UserDao::get(id) -> Usuario existe en BD!");
                } else {
                    error_log("UserDao::get(id) -> Usuario no existe en BD!");
                    $result = 0;
                }
            } else {
                error_log("UserDao::get(id) -> Error al realizar consulta en BD!");
            }
        } catch (PDOException $e) {
            error_log("UserDao::get(id) -> PDOExepcion" . $e);
        }
        return $result;
    }
    public function delete($id)
    {
        $result = false;
        try {
            $query = $this->prepare('DELETE FROM usuarios WHERE id = :id ');
            $query->bindValue('id', $id);
            if ($query->execute()) {
                error_log("UserDao::Delete(id) -> Datos eliminados con exito en BD!");
                $result = true;
            } else {
                error_log("UserDao::Delete(id) -> No se pudieron eliminaron los datos en BD!");
            }
        } catch (PDOException $e) {
            error_log("UserDao::delete(id) -> PDOExepcion " . $e);
        }
        return $result;
    }
    public function update($user)
    {
        $result = false;

        if (UserDao::get($user->id) != null) {
            try {
                $query = $this->prepare('UPDATE usuarios SET
                tipo_id = :tipo_id,
                programa_dependencia_id = :programa_dependencia_id,
                identificacion = :identificacion,
                nombres = :nombres ,
                apellidos = :apellidos,
                email = :email,
                username = :username,
                password = :password,
                activo = :activo,
                hash = :hash WHERE id = :id');
                $query->bindValue('id', $user->id);
                $query->bindValue('tipo_id', $user->tipo_id);
                $query->bindValue('programa_dependencia_id', $user->programa_dependencia_id);
                $query->bindValue('identificacion', $user->identificacion);
                $query->bindValue('nombres', $user->nombres);
                $query->bindValue('email', $user->apellidos);
                $query->bindValue('apellidos', $user->email);
                $query->bindValue('email', $user->username);
                $query->bindValue('password', $user->password);
                $query->bindValue('activo', $user->activo);
                $query->bindValue('hash', $user->hash);
                if ($query->execute()) {
                    error_log("UserDao::Update -> Datos actualizados con exito en BD!");
                    $result = true;
                } else {
                    error_log("UserDao::Update -> Error no se pudieron actualizar los datos en BD!");
                }
            } catch (PDOException $e) {
                error_log("UserDao::Update -> PDOExepcion: " . $e);
            }
        }
        return $result;
    }


    public function isExistsUsernameOrEmail($username, $email)
    {
        $object = null;
        try {
            $queryUsername = $this->prepare("SELECT username FROM `usuarios` WHERE username = '$username'");
            $queryEmail = $this->prepare("SELECT email FROM `usuarios` WHERE username = '$email'");
            $queryUsername->execute();
            $queryEmail->execute();
            $usuario = $queryUsername->fetch(PDO::FETCH_OBJ);
            $mail = $queryEmail->fetch(PDO::FETCH_OBJ);
            if (empty($usuario) || empty($mail)) {
                error_log("UserDao::isExistsUsernameOrEmail(username, email) -> Usuario o Correo ya existe en BD");
                $object = (object) [
                    'username' => empty($usuario) ? 0 : 1,
                    'email' => empty($mail) ? 0 : 1
                ];
            } else {
                error_log("UserDao::isExistsUsernameOrEmail(username, email) -> Usuario y Correo ya existe en BD ");
                $object = (object) [
                    'username' =>  1,
                    'email' =>  1
                ];
            }
        } catch (PDOException $e) {
            error_log("UserDao::isExistsUsernameOrEmail(username, email) -> PDOExepcion:" . $e);
        }
        return $object;
    }

    public function getUserWithKey($key)
    {
        $result = null;
        try {
            $query = $this->prepare('SELECT id,username FROM usuarios WHERE hash = :hash');
            $query->bindValue(':hash', $key);
            if ($query->execute()) {
                error_log("UserDao::getUserWithKey-> Consulta realizada con exito en BD!");
                if ($query->rowCount() > 0) {
                    $user = $query->fetch(PDO::FETCH_ASSOC);
                    $result = UserMapper::eUserMap(
                        $user["id"],
                        $user["username"]
                    );
                    error_log("UserDao::getUserWithKey-> Usuario existe en BD!");
                } else {
                    error_log("UserDao::getUserWithKey -> Usuario no existe en BD!");
                    $result = 0;
                }
            } else {
                error_log("UserDao::getUserWithKey -> Error al realizar consulta en BD!");
            }
        } catch (PDOException $e) {
            error_log("UserDao::getUserWithKey -> PDOExepcion" . $e);
        }
        return $result;
    }

    public function updateToActivatedState($id)
    {
        $result = false;

        if (UserDao::get($id) != null) {
            try {
                $query = $this->prepare("UPDATE usuarios SET
                activo = '1' WHERE id = :id");
                $query->bindValue('id', $id);
                if ($query->execute()) {
                    error_log("UserDao::UpdateToActivatedState -> Estado de usuario actualizado con exito en BD!");
                    $result = true;
                } else {
                    error_log("UserDao::UpdateToActivatedState -> Error no se pudo actualizar estado de usuario en BD!");
                }
            } catch (PDOException $e) {
                error_log("UserDao::UpdateToActivatedState -> PDOExepcion: " . $e);
            }
        }
        return $result;
    }

    public function getUserWithUsername($username)
    {
        $result = null;
        try {
            $query = $this->prepare('SELECT id,username,password,activo, tipo_id FROM usuarios WHERE username = :username');
            $query->bindValue(':username', $username);
            if ($query->execute()) {
                error_log("UserDao::getUserWithUsername-> Consulta realizada con exito en BD!");
                if ($query->rowCount() > 0) {
                    $user = $query->fetch(PDO::FETCH_ASSOC);
                    $result = UserMapper::eLoginUserMap(
                        $user["id"],
                        $user["tipo_id"],
                        $user["username"],
                        $user["password"],
                        $user["activo"]
                    );
                    error_log("UserDao::getUserWithUsername-> Usuario existe en BD!");
                } else {
                    error_log("UserDao::getUserWithUsername -> Usuario no existe en BD!");
                }
            } else {
                error_log("UserDao::getUserWithUsername -> Error al realizar consulta en BD!");
            }
        } catch (PDOException $e) {
            error_log("UserDao::getUserWithUsername -> PDOExepcion" . $e);
        }
        return $result;
    }

    public function getUserWithEmail($email)
    {
        $result = null;
        try {
            $query = $this->prepare('SELECT id,username,password,activo, tipo_id FROM usuarios WHERE email = :email');
            $query->bindValue(':email', $email);
            if ($query->execute()) {
                error_log("UserDao::getUserWithEmail-> Consulta realizada con exito en BD!");
                if ($query->rowCount() > 0) {
                    $user = $query->fetch(PDO::FETCH_ASSOC);
                    $result = UserMapper::eLoginUserMap(
                        $user["id"],
                        $user["tipo_id"],
                        $user["username"],
                        $user["password"],
                        $user["activo"]
                    );
                    error_log("UserDao::getUserWithEmail-> Usuario existe en BD!");
                } else {
                    error_log("UserDao::getUserWithEmail -> Usuario no existe en BD!");
                }
            } else {
                error_log("UserDao::getUserWithEmail -> Error al realizar consulta en BD!");
            }
        } catch (PDOException $e) {
            error_log("UserDao::getUserWithEmail -> PDOExepcion" . $e);
        }
        return $result;
    }

    public function updatePassword($id, $password)
    {
        $result = false;

        if (UserDao::get($id) != null) {
            try {
                $query = $this->prepare("UPDATE usuarios SET
                password = :password WHERE id = :id");
                $query->bindValue('id', $id);
                $query->bindValue('password', $password);
                if ($query->execute()) {
                    error_log("UserDao::UpdateToActivatedState -> Estado de usuario actualizado con exito en BD!");
                    $result = true;
                } else {
                    error_log("UserDao::UpdateToActivatedState -> Error no se pudo actualizar estado de usuario en BD!");
                }
            } catch (PDOException $e) {
                error_log("UserDao::UpdateToActivatedState -> PDOExepcion: " . $e);
            }
        }
        return $result;
    }
}
