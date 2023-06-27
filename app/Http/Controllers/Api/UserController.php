<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\UserServiceContract;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(
        readonly private UserServiceContract $userService
    )
    {
    }

    public function getAllUsers()
    {
        $response = $this->userService->getAllUsers();

        return $this->successResponse();
    }
}
