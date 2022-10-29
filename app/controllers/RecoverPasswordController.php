<?php

class RecoveryPasswordController extends Controller
{
    /**
     * @Inject
     * @var ICodeRecoveryService
     */
    private  $codeRecoveryService;

    public function __construct()
    {
        error_log("RecoveryPasswordController::_construct-> Se inicia constructor del controlador RecoveryPasswordController");
    }

    function recoveryPassword()
    {
        $result = null;

        if ($this->existPOST(['email', 'username'])) {
            $email = $this->getPost('email');
            $username = $this->getPost('username');
            $result = $this->codeRecoveryService->recoveryPassword($username, $email);
            error_log("RecoveryPasswordController::RecoveryPassword-> Se envio codigo de recuperacion");
        } else {
            error_log("RecoveryPasswordController::RecoveryPassword-> No existe el parametro username o email");
        }

        return  $result;
    }

    function updatePassword()
    {
        if ($this->existPOST(['id', 'password'])) {
            error_log("RecoveryPasswordController::updatePassword()-> actualizado password en RecoveryPasswordController");
            $id = $this->getPost('id');
            $password = password_hash($this->getPost('password'), PASSWORD_BCRYPT);
            $this->codeRecoveryService->recoveryPassword($id, $password);
        } else {
            error_log("RecoveryPasswordController::updatePassword()-> No existe el parametro username o email");
        }
    }

    function validateCode()
    {
        $result = null;

        if ($this->existPOST(['codigo'])) {
            error_log("RecoveryPasswordController::validateCode-> validando condigo en RecoveryPasswordController");
            $code = $this->getPost('codigo');
            $result = $this->codeRecoveryService->validateCode($code);
        } else {
            error_log("RecoveryPasswordController::validateCode-> No existe el parametro codigo");
        }

        return  $result;
    }

    function index()
    {
        $this->renderView('recover_password/index');
    }
}
