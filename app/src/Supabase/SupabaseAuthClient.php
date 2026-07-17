<?php

declare(strict_types=1);

namespace App\Supabase;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

final class SupabaseAuthClient
{
    public function __construct(
        private readonly string $supabaseUrl,
        private readonly string $anonKey,
        private readonly ?Client $http = null,
    ) {
    }

    /**
     * @return array{id: string, email: ?string, user_metadata: array, app_metadata: array, created_at: string}|null
     */
    public function getUser(string $accessToken): ?array
    {
        $base = rtrim($this->supabaseUrl, '/');
        $client = $this->http ?? new Client(['timeout' => 10]);

        try {
            $res = $client->request('GET', $base . '/auth/v1/user', [
                'headers' => [
                    'apikey' => $this->anonKey,
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
            ]);
        } catch (GuzzleException) {
            return null;
        }

        if ($res->getStatusCode() !== 200) {
            return null;
        }

        /** @var array<string, mixed> $body */
        $body = json_decode((string) $res->getBody(), true, 512, JSON_THROW_ON_ERROR);

        if (!isset($body['id'])) {
            return null;
        }

        return [
            'id' => (string) $body['id'],
            'email' => isset($body['email']) ? (string) $body['email'] : null,
            'user_metadata' => is_array($body['user_metadata'] ?? null) ? $body['user_metadata'] : [],
            'app_metadata' => is_array($body['app_metadata'] ?? null) ? $body['app_metadata'] : [],
            'created_at' => (string) ($body['created_at'] ?? ''),
        ];
    }

    public static function fromEnv(): self
    {
        $url = $_ENV['SUPABASE_URL'] ?? getenv('SUPABASE_URL') ?: '';
        $anon = $_ENV['SUPABASE_ANON_KEY'] ?? getenv('SUPABASE_ANON_KEY') ?: '';

        if ($url === '' || $anon === '') {
            throw new \RuntimeException('SUPABASE_URL and SUPABASE_ANON_KEY are required');
        }

        return new self($url, $anon);
    }
}
