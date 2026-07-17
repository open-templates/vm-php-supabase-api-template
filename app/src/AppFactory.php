<?php

declare(strict_types=1);

namespace App;

use App\Http\JsonResponder;
use App\Middleware\AuthMiddleware;
use App\Middleware\CorsMiddleware;
use App\Middleware\ErrorMiddleware;
use App\Routes\HealthRoutes;
use App\Routes\MeRoutes;
use Slim\Factory\AppFactory as SlimAppFactory;

final class AppFactory
{
    public static function create(): \Slim\App
    {
        $app = SlimAppFactory::create();
        $app->addBodyParsingMiddleware();
        $app->addRoutingMiddleware();

        $responder = new JsonResponder();
        $app->add(new ErrorMiddleware($responder));
        $app->add(new CorsMiddleware());

        (new HealthRoutes($responder))->register($app);

        $app->group('', function ($group) use ($responder) {
            $group->add(new AuthMiddleware($responder));
            (new MeRoutes($responder))->register($group);
        });

        $app->map(['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'], '/{routes:.+}', function ($request, $response) use ($responder) {
            return $responder->error($response, 'Not Found', 'NOT_FOUND', 404);
        });

        return $app;
    }
}
