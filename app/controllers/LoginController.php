<?php



class LoginController extends Controller
{
    /**
     * @Inject
     * @var IUserService
     */
    private $userService;

    public function __construct()
    {
        error_log("LoginController::_construct-> Se inicia constructor del controlador LoginController");
    }

    function loginVerification()
    {
        if ($this->existPOST(['username', 'password'])) {
            $username = $this->getPost('username');
            $password = $this->getPost('password');
            return $this->userService->userLoginVerification($username, $password);
            error_log("LoginController::loginVerification-> Verificacion de login en controlador LoginController");
        } else {
            error_log("LoginController::loginVerification-> No existe el parametro username o password");
        }
    }

    function index()
    {
        $this->renderView('login/index');
    }
}
