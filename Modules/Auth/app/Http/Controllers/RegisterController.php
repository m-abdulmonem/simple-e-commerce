<?php

namespace Modules\Auth\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\app\Http\Requests\RegisterRequest;
use Modules\Auth\app\Models\User;
use Modules\Auth\app\Resources\UserResource;
use Throwable;

class RegisterController extends Controller
{

    /**
     * @param RegisterRequest $request The request object containing the user data.
     * @return \Illuminate\Http\JsonResponse The JSON response.
     *@author Mohamed Abdelmonem <mabdulalmonem@gmail.com>
     *
     * Handles the registration process for a user in a Laravel application.
     *
     * It creates a new user using the `User::create()` method.
     * After creating the user, it assigns a token to the user using the `createToken()` method provided by Laravel Sanctum.
     * Finally, it returns a JSON response with the user data and a success message.
     * If an exception is thrown during the process, it returns a JSON response with the error message.
     *
     */
    public function __invoke(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $user = User::create($request->all());
            $user->token = $user->createToken('new-mobile-app-user')->plainTextToken;

            return json(
                new UserResource($user),
                message: __('Account created successfully')
            );

        }catch (Throwable $throwable){

            return json(
                $throwable->getMessage(),
                status: "error",
                headerStatus: 500
            );
        }
    }
}
