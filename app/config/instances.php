<?php

return [
    IUserService::class => DI\get(UserService::class),
    // app_desarrollo_web\app\services\contract\User\IUserService::class => DI\get(\app_desarrollo_web\app\services\implement\User\UserService::class),
    IProgramDependencyService::class => DI\get(ProgramDependencyService::class),
    IUserTypeService::class => DI\get(UserTypeService::class),
];
