<?php

require "../app/services/contract/User/IUserService.php";
require "../app/dao/Repository/IUserRepository.php";
require "../app/helper/ViewActivations/ActivatedAccountViews.php";
require "../app/helper/Validators/LoginValidator.php";

class UserService implements IUserService
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function userKeyVerification($key)
    {
        $verification = false;
        $eUser = $this->userRepository->getUserWithKey($key);
        if (!empty($eUser)) {
            $keyVerification = hash('sha256', $eUser->username);
            if ($keyVerification == $key) {
                if ($this->userRepository->updateToActivatedState($eUser->id)) {
                    $verification = true;
                    error_log("UserService::UserKeyVerification -> Usuario verificado correctamente!");
                }
            }
        } else {
            error_log("UserService::UserKeyVerification -> Error al consultar key, es incorrecta o no existe en BD!");
        }
        if ($verification) {
            ActivatedAccountViews::ActivationSuccess();
            error_log("UserService::UserKeyVerification -> Se renderiza ActivationSuccess!");
        } else {
            ActivatedAccountViews::ActivationeError();
            error_log("UserService::UserKeyVerification -> Se renderiza ActivationeError!");
        }
    }

    public function userLoginVerification($username, $password)
    {
        $eUserLogin = $this->userRepository->getUserWithUsername($username);
        return LoginValidator::loginValidationExistAndActivated($eUserLogin,  $password);
    }

    public function userRegistration($user)
    {
        $objValidate =  $this->userRepository->isExistsUsernameOrEmail($user->username, $user->email);
        $isUpdate = false;

        if ($objValidate->username == 0 && $objValidate->email == 0) {
            $isUpdate = $this->userRepository->save($user);
        }

        if ($isUpdate) {
            MailerBuilder::sendActivationMail($user);
            error_log("UserService:: userRegistration -> Usuario registrado con exito!");
        } else {
            error_log("UserService:: userRegistration -> error al registrar usuario!");
        }

        return $objValidate;
    }
}
