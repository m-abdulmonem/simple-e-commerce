<?php

namespace Modules\Auth\app\Http\Requests;

use App\Http\Requests\BaseApiRequest;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'auth' => 'required',
            'password' => 'required'
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
