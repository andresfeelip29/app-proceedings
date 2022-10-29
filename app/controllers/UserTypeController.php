<?php
class UserTypeController extends Controller
{

    /**
     * @Inject
     * @var IUserTypeService
     */

    private  $userTypeService;

    public function __construct()
    {

        error_log("ProgramDependencyController::_construct-> Se inicia constructor del controlador ProgramDependencyController");
    }

    function listAllUserType()
    {
        $listUserType = $this->userTypeService->getAllUserType();
        if (!empty($listUserType)) {
            error_log("ProgramDependencyController::listAllProgramDependency-> Se carga listado de depenendencias");
        } else {
            error_log("ProgramDependencyController::listAllProgramDependency-> No se pudo cargar listado de depenendencias");
        }
        return json_encode($listUserType);
    }
}
