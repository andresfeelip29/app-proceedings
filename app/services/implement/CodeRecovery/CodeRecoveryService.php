<?php

require "./services/contract/CodeRecovery/ICodeRecoveryService.php";
require "./dao/Repository/ICodeRecoveryRepository.php";
require "./helper/Generated/GenerateRecoveryPasswordCode.php";
require "./dao/Mapper/CodeRecoveryMapper.php";
require "./helper/Mail/MailerBuilder.php";

class CodeRecoveryService implements ICodeRecoveryService
{
    private ICodeRecoveryRespository $codeRecoveryRespository;
    private IUserRepository $userRepository;

    public function __construct(ICodeRecoveryRespository $codeRecoveryRespository, IUserRepository $userRepository)
    {
        $this->codeRecoveryRespository = $codeRecoveryRespository;
        $this->userRepository = $userRepository;
    }

    public function recoveryPassword($username, $email)
    {
        $objValidate =  $this->userRepository->isExistsUsernameOrEmail($username, $email);
        $isRecovery = false;
        $userRecovery = null;
        $code = GenerateRecoveryPasswordCode::generateCode();

        if ($objValidate->username == 1 || $objValidate->email == 1) {
            if ($objValidate->username == 1) {
                $userRecovery = $this->userRepository->getUserWithUsername($username);
                $isRecovery =  $this->codeRecoveryRespository->save(CodeRecoveryMapper::Map(null, $userRecovery->id, $code, 0));
                error_log("CodeRecoveryService::recoveryPassword -> recuperacion de contraeña con usuario!");
            } else if ($objValidate->email == 1) {
                $userRecovery = $this->userRepository->getUserWithEmail($email);
                $isRecovery =  $this->codeRecoveryRespository->save(CodeRecoveryMapper::Map(null, $userRecovery->id, $code, 0));
                error_log("CodeRecoveryService::recoveryPassword -> recuperacion de contraeña con email!");
            }
        }

        if ($isRecovery) {
            MailerBuilder::sendRecoveryMail($userRecovery, $code);
            error_log("CodeRecoveryService::recoveryPassword -> condigo enviado por email!");
        }

        return $objValidate;
    }

    public function updatePassword($id, $password)
    {
        if ($this->userRepository->updatePassword($id, $password)) {
            error_log("CodeRecoveryService::updatePassword -> Contraseña actualizada!");
        } else {
            error_log("CodeRecoveryService::updatePassword -> error al actualizar contraseña!");
        }
    }

    public function validateCode($code)
    {
        $response = $this->codeRecoveryRespository->getCodeWithCode($code);
        if ($response->existe == 1 && $response->estado == 0) {
            error_log("CodeRecoveryService::validateCode -> codigo existe y no ha sido usado");
            if ($this->codeRecoveryRespository->updateCodeStatus($response->id_codigo, 1)) {
                error_log("CodeRecoveryService::validateCode -> estatus de codigo actualizado");
            } else {
                error_log("CodeRecoveryService::validateCode -> no se pudo actualizar estatus de codigo");
            }
        }
        return $response;
    }
}
