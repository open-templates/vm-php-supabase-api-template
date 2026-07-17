<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Http\JsonResponder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;
use Throwable;

final class ErrorMiddleware implements MiddlewareInterface
{
    public function __construct(private readonly JsonResponder $responder)
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (Throwable $e) {
            error_log($e->getMessage());
            $response = new Response();
            return $this->responder->error(
                $response,
                $e->getMessage() !== '' ? $e->getMessage() : 'Internal server error',
                'INTERNAL_SERVER_ERROR',
                500,
            );
        }
    }
}
