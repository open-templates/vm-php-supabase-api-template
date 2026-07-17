<?php

declare(strict_types=1);

namespace App\Routes;

use App\Http\JsonResponder;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

final class HealthRoutes
{
    public function __construct(private readonly JsonResponder $responder)
    {
    }

    public function register(App $app): void
    {
        $app->get('/health', [$this, 'health']);
    }

    public function health(Request $request, Response $response): Response
    {
        return $this->responder->success($response, [
            'status' => 'healthy',
            'timestamp' => (new \DateTimeImmutable('now'))->format(\DateTimeInterface::ATOM),
        ]);
    }
}
