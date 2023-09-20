<?php

namespace app\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    protected AuthService $authService;

    /**
     * AuthController constructor.
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Authenticate a user and return tokens.
     *
     * @OA\Post(
     *     path="/api/v1/auth/login",
     *     summary="Authenticate user",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Successful authentication"),
     *     @OA\Response(response=401, description="Authentication failed")
     * )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $tokens = $this->authService->authenticateUser($request);
        if (!$tokens) {
            return response()->json(['error' => 'Authentication failed'], HttpResponse::HTTP_UNAUTHORIZED);
        }
        return response()->json($tokens, HttpResponse::HTTP_OK);
    }

    /**
     * Register a new user and return tokens.
     *
     * @OA\Post(
     *     path="/api/v1/auth/registration",
     *     summary="Register a new user",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Successful registration"),
     *     @OA\Response(response=401, description="Registration failed")
     * )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function registration(Request $request): JsonResponse
    {
        $tokens = $this->authService->registerUser($request);
        if (!$tokens) {
            return response()->json(['error' => 'Registration failed'], HttpResponse::HTTP_UNAUTHORIZED);
        }
        return response()->json($tokens, HttpResponse::HTTP_OK);
    }

    /**
     * Update tokens using a valid refreshToken.
     *
     * @OA\Post(
     *     path="/api/v1/auth/updateToken",
     *     summary="Update tokens using refreshToken",
     *     tags={"Authentication"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="refreshToken", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Tokens updated successfully"),
     *     @OA\Response(response=401, description="Invalid or expired refreshToken")
     * )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateToken(Request $request): JsonResponse
    {
        $tokens = $this->authService->updateTokens($request);
        if (!$tokens) {
            return response()->json(['error' => 'Invalid or expired refreshToken'], HttpResponse::HTTP_UNAUTHORIZED);
        }
        return response()->json($tokens, HttpResponse::HTTP_OK);
    }
}
