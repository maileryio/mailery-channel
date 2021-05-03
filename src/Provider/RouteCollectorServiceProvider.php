<?php

namespace Mailery\Channel\Provider;

use Psr\Container\ContainerInterface;
use Yiisoft\Di\Support\ServiceProvider;
use Yiisoft\Router\RouteCollectorInterface;
use Yiisoft\Router\Group;
use Yiisoft\Router\Route;
use Mailery\Channel\Controller\DefaultController;

final class RouteCollectorServiceProvider extends ServiceProvider
{
    public function register(ContainerInterface $container): void
    {
        /** @var RouteCollectorInterface $collector */
        $collector = $container->get(RouteCollectorInterface::class);

        $collector->addGroup(
            Group::create('/channel')
                ->routes(
                    Route::get('/default/index')
                        ->action([DefaultController::class, 'index'])
                        ->name('/channel/default/index'),
                    Route::get('/default/view/{id:\d+}')
                        ->action([DefaultController::class, 'view'])
                        ->name('/channel/default/view'),
                    Route::methods(['GET', 'POST'], '/default/create')
                        ->action([DefaultController::class, 'create'])
                        ->name('/channel/default/create'),
                    Route::methods(['GET', 'POST'], '/default/edit/{id:\d+}')
                        ->action([DefaultController::class, 'edit'])
                        ->name('/channel/default/edit'),
                    Route::delete('/default/delete/{id:\d+}')
                        ->action([DefaultController::class, 'delete'])
                        ->name('/channel/default/delete'),
                )
        );
    }
}
