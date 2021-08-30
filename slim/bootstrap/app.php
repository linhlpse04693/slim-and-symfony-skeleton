<?php

use App\Http\Kernel;
use DI\ContainerBuilder;
use DI\Bridge\Slim\Bridge as SlimFactory;

$builder = new ContainerBuilder();

try {
    $container = $builder->build();
    $app = SlimFactory::create($container);

    return Kernel::bootstrap($app)->getApplication();
} catch (Exception $e) {
    //
}
