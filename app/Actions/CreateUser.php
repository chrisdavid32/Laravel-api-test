<?php

namespace App\Actions;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRegistrationRequest;

class CreateUser
{
       /**
     * Create a new user
     *
     * @param UserRegistrationRequest $request
     * @return void
     */
    public function registration(UserRegistrationRequest $request)
    {
        try {
            DB::beginTransaction();

            //create data
            $data = $request->except(['password_confirmation']);
            $data['password'] = Hash::make($request->password);
            $newUser = User::create($data);

            DB::commit();

            //register user data
            return  new UserResource($newUser);

        } catch (Exception $e) {
            Log::error($e->getMessage(), [$e]);
            DB::rollback();
            abort(400, "Unable to create account, please try again later.", [$e->getMessage()]);
        }
    }
}
