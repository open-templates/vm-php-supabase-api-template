<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Auth\JwtExtractor;
use App\Http\JsonResponder;
use App\Supabase\SupabaseAuthClient;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class AuthMiddleware implements MiddlewareInterface
{
    public function __construct(private readonly JsonResponder $responder)
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $token = JwtExtractor::fromAuthorizationHeader($request->getHeaderLine('Authorization'));
        if ($token === null) {
            $response = new \Slim\Psr7\Response();
            return $this->responder->error($response, 'Unauthorized', 'UNAUTHORIZED', 401);
        }

        $user = SupabaseAuthClient::fromEnv()->getUser($token);
        if ($user === null) {
            $response = new \Slim\Psr7\Response();
            return $this->responder->error($response, 'Unauthorized', 'UNAUTHORIZED', 401);
        }

        return $handler->handle($request->withAttribute('user', $user));
    }
}
