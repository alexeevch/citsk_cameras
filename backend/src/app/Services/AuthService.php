<?php

namespace App\Services;

use App\Data\Auth\LoginData;
use App\Data\User\UserResourceData;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * Выполняет аутентификацию пользователя
     *
     * @param  LoginData  $loginData
     *
     * @return UserResourceData
     * @throws AuthenticationException
     */
    public function login(LoginData $loginData): UserResourceData
    {
        $credentials = [
            'email'    => $loginData->email,
            'password' => $loginData->password,
        ];

        $remember = $loginData->rememberMe;

        if (!Auth::attempt($credentials, $remember)) {
            throw new AuthenticationException('Неверные учетные данные.');
        }

        $user = Auth::user();

        if ($user->is_blocked) {
            Auth::logout();
            throw new AuthenticationException('Аккаунт заблокирован.');
        }


        request()->session()->regenerate();

        return UserResourceData::from($user);
    }

    public function logout(): void
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }

    /**
     * Возвращает данные текущего пользователя
     *
     * @return UserResourceData
     * @throws AuthenticationException
     */
    public function me(): UserResourceData
    {
        $user = Auth::user();

        if (!$user) {
            throw new AuthenticationException('Пользователь не аутентифицирован.');
        }

        return UserResourceData::fromModel($user);
    }
}
