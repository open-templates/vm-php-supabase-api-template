<?php

declare(strict_types=1);

namespace App\Http;

use Psr\Http\Message\ResponseInterface as Response;

final class JsonResponder
{
    public function success(Response $response, array $data, int $status = 200): Response
    {
        return $this->json($response, ['success' => true, 'data' => $data], $status);
    }

    public function error(Response $response, string $message, string $code, int $status = 400, ?array $details = null): Response
    {
        $error = ['message' => $message, 'code' => $code];
        if ($details !== null) {
            $error['details'] = $details;
        }

        return $this->json($response, ['success' => false, 'error' => $error], $status);
    }

    private function json(Response $response, array $payload, int $status): Response
    {
        $response->getBody()->write((string) json_encode($payload, JSON_THROW_ON_ERROR));
        return $response->withHeader('Content-Type', 'application/json')->withStatus($status);
    }
}
