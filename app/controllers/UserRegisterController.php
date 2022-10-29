<?php

class UserRegisterController extends Controller
{
    /**
     * @Inject
     * @var IUserService
     */
    private  $userService;
    /**
     * @Inject
     * @var IProgramDependencyService
     */
    private  $programDependencyService;
    /**
     * @Inject
     * @var IUserTypeService
     */

    private  $userTypeService;
    
    

    public function __construct(IUserService $userService, IProgramDependencyService $programDependencyService, IUserTypeService $userTypeService)
    {
        $this->userService = $userService;
        $this->programDependencyService = $programDependencyService;
        $this->userTypeService = $userTypeService;


        error_log("UserRegisterController::_construct-> Se inicia constructor del controlador UserRegisterController");
    }

    public function keyVerification()
    {
        if ($this->existGET(['key'])) {
            $key = $this->getGet('key');
            $this->userService->userKeyVerification($key);
            error_log("UserRegisterController::keyVerification-> Verificacion de key en controlador");
        } else {
            error_log("UserRegisterController::keyVerification-> No existe el parametro key");
        }
    }

    public function userRegistration()
    {
        if ($this->existPOST(['username', 'nombres', 'apellidos', 'identificacion', 'email', 'tipo_id', 'username', 'password', 'programa_dependencia_id', 'activo'])) {
            $username = $this->getPost('username');
            $nombres = $this->getPost('nombres');
            $apellidos = $this->getPost('apellidos');
            $identificacion = $this->getPost('identificacion');
            $email = $this->getPost('email');
            $tipo_id = $this->getPost('tipo_id');
            $username = $this->getPost('username');
            $password = password_hash($this->getPost('password'), PASSWORD_BCRYPT);
            $programa_dependencia_id = $this->getPost('programa_dependencia_id');
            $activo = $this->getPost('activo');
            $hash = hash('sha256', $username);

            return $this->userService->userRegistration(
                UserMapper::Map(
                    null,
                    $tipo_id,
                    $programa_dependencia_id,
                    $identificacion,
                    $nombres,
                    $apellidos,
                    $email,
                    $username,
                    $password,
                    $activo,
                    $hash
                )

            );
            error_log("UserRegisterController::userRegistration-> Usuario registrado con exito");
        } else {
            error_log("UserRegisterController::userRegistration-> Parametros incorrectos para registrar usuario");
        }
    }

    public function index()
    {
        $this->renderView('register/index');
    }

    public function listAllProgramDependency()
    {
        $listDependencies = $this->programDependencyService->getAllProgramDependency();

        if (!empty($listDependencies)) {
            error_log("ProgramDependencyController::listAllProgramDependency-> Se carga listado de depenendencias");
        } else {
            error_log("ProgramDependencyController::listAllProgramDependency-> No se pudo cargar listado de depenendencias");
        }
        return $listDependencies;
    }

    public function listAllUserType()
    {
        $listUserType = $this->userTypeService->getAllUserType();
        if (!empty($listUserType)) {
            error_log("ProgramDependencyController::listAllProgramDependency-> Se carga listado de depenendencias");
        } else {
            error_log("ProgramDependencyController::listAllProgramDependency-> No se pudo cargar listado de depenendencias");
        }
        return $listUserType;
    }
}
