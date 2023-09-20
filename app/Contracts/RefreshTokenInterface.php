<?php

namespace App\Contracts;

use App\Models\User;
use Laravel\Passport\RefreshToken;

interface RefreshTokenInterface
{
    public function createRefreshToken(User $user, string $ua, string $fingerprint, string $ip, int $expiresIn): string;
    public function findRefreshToken(string $token): ?RefreshToken;
}
