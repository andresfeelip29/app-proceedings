<?php

require "./services/contract/UserType/IUserTypeService.php";
require "./dao/Repository/IUserTypeRepository.php";


class UserTypeService implements IUserTypeService
{
    /**
     * @Inject
     * @var IUserTypeRepository
     */
    private  $userTypeRepository;

    public function __construct()
    {
    }

    public function getAllUserType()
    {
        $collectionUserType = $this->userTypeRepository->getAll();
        if (!empty($collectionUserType)) {
            error_log("UserTypeService::getAllUserType -> Tipos de usuarios obtenidos correctamente!");
        } else {
            error_log("UserTypeService::getAllUserType -> No existen tipos de usuarios para cargar!");
        }
        return $collectionUserType;
    }
}
