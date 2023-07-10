<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\UserServiceContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        readonly private UserServiceContract $userService
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function getAllUsers(): JsonResponse
    {
        $response = $this->userService->getAllUsers();

        return $this->sendResponse($response);
    }
}
