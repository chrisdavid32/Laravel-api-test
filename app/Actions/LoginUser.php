<?php

namespace App\Actions;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRegistrationRequest;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class LoginUser
{
    public function execute(LoginRequest $request)
    {
        //find user
        $userEmail = User::whereEmail($request->email)->first();
        if($userEmail){
            return $this->login($userEmail, $request->password);
        }

        abort(400, "Invalid login credentials provided.");
    }

    private function login(User $user, String $password)
    {
        //verify password;
        $isPasswordValid = Hash::check($password, $user->password);
        abort_if(!$isPasswordValid, 400,  "Invalid login credentials provided.");

        $token = $user->createToken("auth_token")->plainTextToken;
        return [
            "user" => new UserResource($user),
            "token" => $token
        ];
    }

}
