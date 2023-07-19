<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\AuthServiceContract;
use App\Dto\Auth\LoginUserDto;
use App\Dto\Auth\RegistrationUserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Resources\Auth\AuthTokenResource;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthServiceContract $authService
    )
    {
    }

    public function registration(RegistrationRequest $request): JsonResponse
    {
        $response = $this->authService->registration(new RegistrationUserDto(
            firstName: $request->get('first_name'),
            lastName: $request->get('last_name'),
            username: $request->get('username'),
            email: $request->get('email'),
            password: $request->get('password'),
            remember: $request->boolean('remember')
        ));

        return $this->sendResponse(new AuthTokenResource([
            'token' => $response
        ]));
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $response = $this->authService->login(new LoginUserDto(
            email: $request->get('email'),
            password: $request->get('password')
        ));

        return $this->sendResponse(new AuthTokenResource([
            'token' => $response
        ]));
    }

    public function logout(): JsonResponse
    {
        $this->authService->logout();

        return $this->sendResponse(code: 204);
    }
}
