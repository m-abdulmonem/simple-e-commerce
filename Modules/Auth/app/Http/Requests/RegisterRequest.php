<?php

namespace Modules\Auth\app\Http\Requests;

use App\Http\Requests\BaseApiRequest;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\app\Rules\MinWords;

class RegisterRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'     => ['required', new MinWords(2)],
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|numeric|min:8|confirmed',
            'phone'    => 'required'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

}
