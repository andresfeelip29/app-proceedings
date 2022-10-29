<?php

interface IUserService
{
    public function userKeyVerification($key);
    public function userLoginVerification($username, $password);
    public function userRegistration($user);
}
