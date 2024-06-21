<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class ApiTokenRegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => ['required','email','max:255',Rule::exists(User::class,'email')],
            'password' => 'required|string|min:8',
            'token_name' => 'required'
        ];
    }
}