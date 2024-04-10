<?php

namespace App\Http\Controllers;

use App\Actions\LoginUser;
use App\Actions\CreateUser;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRegistrationRequest;

class OnbordingController extends Controller
{
    protected CreateUser $creatUser;
    protected LoginUser $loginUser;

    public function __construct ()
    {
        $this->creatUser = new CreateUser();
        $this->loginUser = new LoginUser();
    }

     /**
     * Create new account
     *
     * @param UserRegistrationRequest $request
     * @return JsonResponse
     */
    public function registerNewUser(UserRegistrationRequest $request): JsonResponse
    {
        $response = $this->creatUser->registration($request);
        return $this->successResponse($response, "Account created successfully", 201);
    }

     /**
     * User login
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function Login(LoginRequest $request): JsonResponse
    {
        $response = $this->loginUser->execute($request);
        return $this->successResponse($response, "Login successful.");
    }
}
