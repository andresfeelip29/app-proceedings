<?php



class ProgramDependencyService implements IProgramDependencyService
{
    /**
     * @Inject
     * @var IProgramDependencyRepository
     */
    private  $programDependencyRepository;

    public function __construct()
    {
    }

    public function getAllProgramDependency()
    {
        $collectionDependenciesProgramas = $this->programDependencyRepository->getAll();
        if (!empty($collectionDependenciesProgramas)) {
            error_log("UserService::getAllProgramDependency -> Dependencias cargadas correctamente!");
        } else {
            error_log("UserService::getAllProgramDependency -> No existen depenedencias para cargar!");
        }
        return $collectionDependenciesProgramas;
    }
}
