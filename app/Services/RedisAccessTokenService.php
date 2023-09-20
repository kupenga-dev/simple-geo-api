<?php

namespace App\Services;

use App\Contracts\AccessTokenInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;
use Laravel\Passport\Bridge\AccessToken;
use Illuminate\Redis\Connections\Connection;
use Laravel\Passport\Bridge\RefreshToken;


class RedisAccessTokenService implements AccessTokenInterface
{
    private Connection $redis;

    public function __construct()
    {
        $this->redis = Redis::connection();
    }

    /**
     * @param User $user
     * @param string $name
     * @return string
     * @throws \Exception
     */
    public function createAccessToken(User &$user, string $name): string
    {
        $token = bin2hex(random_bytes(60));
        $expiresAt = Carbon::now()->addMinutes(30);
        $this->redis->set('access_token:' . $token, $expiresAt->diffInSeconds(), json_encode($user->toArray()));
        return $token;
    }

    /**
     * @param string $token
     * @return AccessToken|null
     */
    public function findAccessToken(string $token): ?User
    {
        $accessTokenKey = 'access_token:' . $token;
        $accessToken = $this->redis->get($accessTokenKey);
        if (!$accessToken){
            return null;
        }
        $userData = json_decode($this->redis->get($accessTokenKey), true);
        $user = new User();
        $user->fill($userData);
        return $user;
    }

    public function restoreAccessToken(string $refreshToken): string
    {

    }
}
