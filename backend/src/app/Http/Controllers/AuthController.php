<?php

namespace App\Http\Controllers;

use App\Data\Auth\LoginData;
use App\Services\AuthService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    )
    {
    }

    public function login(Request $request): JsonResponse
    {
        try {
            $loginData = LoginData::from($request);
            $user = $this->authService->login($loginData);

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'Успешный вход в систему'
            ]);
        } catch (AuthenticationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout(): JsonResponse
    {
        $this->authService->logout();

        return response()->json([
            'success' => true,
            'message' => 'Успешный выход из системы'
        ]);
    }

    public function me(): JsonResponse
    {
        try {
            $user = $this->authService->me();

            return response()->json([
                'success' => true,
                'data' => $user,
                'id' => session()->getId(),
            ]);
        } catch (AuthenticationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}
