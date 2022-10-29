<?php

require 'vendor/autoload.php';
$container = new DI\Container();


// $containerBuilder = new \DI\ContainerBuilder();
// $containerBuilder->useAutowiring(true);

$container = $container->get(UserRegisterController::class);

spl_autoload_register(function ($nameClass) {
    require_once 'libs/core/' . $nameClass . '.php';
});

spl_autoload_register(function ($nameClass) {
    require_once 'controllers/' . $nameClass . '.php';
});

spl_autoload_register(function ($nameClass) {
    require_once 'dao/' . $nameClass . '.php';
});

spl_autoload_register(function ($nameClass) {
    require_once 'config/' . $nameClass . '.php';
});


// $app = new App();

// $containerBuilder = new \DI\ContainerBuilder();
// $containerBuilder->useAutowiring(true);
// $containerBuilder->addDefinitions(__DIR__.'\config\instances.php');
// $container = $containerBuilder->build();

// echo $container->get(UserRegisterController::class);


