<?php

declare(strict_types=1);

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;

final class CorsMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $origin = $request->getHeaderLine('Origin');
        $allowed = $this->allowedOrigins();

        $allowOrigin = '*';
        if ($allowed !== []) {
            if ($origin !== '' && in_array($origin, $allowed, true)) {
                $allowOrigin = $origin;
            } else {
                $allowOrigin = $allowed[0];
            }
        } elseif ($origin !== '') {
            $allowOrigin = $origin;
        }

        if ($request->getMethod() === 'OPTIONS') {
            $response = new Response(204);
            return $this->withCorsHeaders($response, $allowOrigin);
        }

        $response = $handler->handle($request);
        return $this->withCorsHeaders($response, $allowOrigin);
    }

    /** @return list<string> */
    private function allowedOrigins(): array
    {
        $raw = $_ENV['ALLOWED_ORIGINS'] ?? getenv('ALLOWED_ORIGINS') ?: '';
        if ($raw === '') {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $raw))));
    }

    private function withCorsHeaders(ResponseInterface $response, string $allowOrigin): ResponseInterface
    {
        return $response
            ->withHeader('Access-Control-Allow-Origin', $allowOrigin)
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Credentials', 'true');
    }
}
