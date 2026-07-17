<?php

declare(strict_types=1);

namespace App\Auth;

final class JwtExtractor
{
    public static function fromAuthorizationHeader(?string $header): ?string
    {
        if ($header === null || $header === '') {
            return null;
        }

        if (preg_match('/^Bearer\s+(\S+)$/i', trim($header), $m) !== 1) {
            return null;
        }

        return $m[1];
    }
}
