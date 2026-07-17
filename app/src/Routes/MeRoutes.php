<?php

declare(strict_types=1);

namespace App\Routes;

use App\Http\JsonResponder;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface;

final class MeRoutes
{
    public function __construct(private readonly JsonResponder $responder)
    {
    }

    public function register(RouteCollectorProxyInterface $group): void
    {
        $group->get('/me', [$this, 'me']);
    }

    public function me(Request $request, Response $response): Response
    {
        /** @var array{id: string, email: ?string, user_metadata: array, app_metadata: array, created_at: string} $user */
        $user = $request->getAttribute('user');

        return $this->responder->success($response, $user);
    }
}
