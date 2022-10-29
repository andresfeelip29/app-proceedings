<?php

require "IRepository.php";

interface IUserRepository extends IRepository
{
    public function isExistsUsernameOrEmail($username, $email);

    public function getUserWithKey($key);

    public function updateToActivatedState($id);

    public function getUserWithUsername($username);

    public function getUserWithEmail($email);

    public function updatePassword($id, $password);
}
