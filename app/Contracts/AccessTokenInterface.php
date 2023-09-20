<?php

namespace App\Contracts;

use App\Models\User;

interface AccessTokenInterface
{
    public function createAccessToken(User &$user, string $name): string;
    public function findAccessToken(string $token): ?User;
    public function restoreAccessToken(string $refreshToken): string;
}
