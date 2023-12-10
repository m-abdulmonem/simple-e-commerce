<?php

namespace Modules\Auth\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\app\Http\Requests\LoginRequest;
use Modules\Auth\app\Models\User;
use Modules\Auth\app\Resources\UserResource;

class LoginController extends Controller
{

    /**
     * @param LoginRequest $request The request object containing the authentication input and password.
     * @return \Illuminate\Http\JsonResponse The JSON response.
     *@author Mohamed Abdelmonem <mabdulalmonem@gmail.com>
     *
     * Handles the login process for a user in a Laravel application.
     *
     * This function first checks if the user exists. If the user exists, it checks if the password provided matches the stored password.
     * If the password is correct, it logs the user in and returns a JSON response with the user data and a success message.
     * If the user does not exist or the password is incorrect, it returns a JSON response with an error message.
     *
     */
    public function __invoke(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        if (! ($user = $this->isExists($request))) {

            return json(__('Account not found'), status: 'error', headerStatus: 422);
        }

        if (!Hash::check($request->password, $user->password)) {

            return json(__('Password Doest Match'), status: 'error', headerStatus: 422);
        }

        return $this->login($user);
    }

    /**
     * @return \Illuminate\Http\JsonResponse The JSON response.
     *@author Mohamed Abdelmonem <mabdulalmonem@gmail.com>
     *
     * Handles the logout process for a user
     *
     * This function first deletes the user's tokens using the `tokens()->delete()` method provided by Laravel Sanctum.
     * Then, it returns a JSON response with a success message.
     *
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth()->user()->tokens()->delete();

        return json(__('Successfully logged out'));
    }

    /**
     * @author Mohamed Abdelmonem <mabdulalmonem@gmail.com>
     *
     * Checks if a user exists in the database based on the authentication input provided in a request.
     *
     * This function uses the `User::firstWhere()` method to retrieve the first user that matches the given conditions.
     * The conditions are based on the type of the authentication input (phone number or email) and the authentication input itself.
     *
     * @param FormRequest $request The request object containing the authentication input.
     * @return Model|Builder|null Returns the first user that matches the given conditions, or null if no user matches the conditions.
     */
    private function isExists(FormRequest $request): Model|Builder|null
    {
        return User::firstWhere(
            $this->getAuthInputType($request),
            $request->auth
        );
    }

    /**
     * @author Mohamed Abdelmonem <mabdulalmonem@gmail.com>
     *
     * Determines the type of authentication input provided in a request.
     *
     * This function checks if the authentication input is a phone number or an email.
     * It uses the `is_phone()` function to check if the input is a phone number.
     * If the input is a phone number, it returns 'phone'. If the input is not a phone number,
     * it returns 'email'.
     *
     * @param FormRequest $request The request object containing the authentication input.
     * @return string Returns 'phone' if the authentication input is a phone number, 'email' otherwise.
     */
    private function getAuthInputType(FormRequest $request): string
    {
        return is_phone($request->auth) ? 'phone' : 'email';
    }

    /**
     * @param User|Model $user The user object.
     * @return \Illuminate\Http\JsonResponse The JSON response.
     * @author Mohamed Abdelmonem <mabdulalmonem@gmail.com>
     *
     * Handles the login process for a user in a Laravel application using Laravel Sanctum for API token authentication.
     *
     * This function first removes old tokens of the client using the `tokens()->delete()` method provided by Laravel Sanctum.
     * Then, it creates a new token for the user using the `createToken()` method provided by Laravel Sanctum.
     * Finally, it returns a JSON response with the user data and a success message.
     *
     */
    private function login(User|Model $user): \Illuminate\Http\JsonResponse
    {
        ///remove old tokens of clients
        $user->tokens()->delete();

        ///create new token
        $user->token = $user->createToken("mobile-app-user")->plainTextToken;

        ///success response
        return json((new  UserResource($user)), message: __('Logged in successfully'));
    }
}
