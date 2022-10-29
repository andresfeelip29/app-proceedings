<?php



class ProgramDependencyController extends Controller
{
    /**
     * @Inject
     * @var IProgramDependencyService
     */
    private  $programDependencyService;

    public function __construct()
    {
        error_log("ProgramDependencyController::_construct-> Se inicia constructor del controlador ProgramDependencyController");
    }

    function listAllProgramDependency()
    {
        $listDependencies = $this->programDependencyService->getAllProgramDependency();

        if (!empty($listDependencies)) {
            error_log("ProgramDependencyController::listAllProgramDependency-> Se carga listado de depenendencias");
        } else {
            error_log("ProgramDependencyController::listAllProgramDependency-> No se pudo cargar listado de depenendencias");
        }
        return $listDependencies;
    }
}
