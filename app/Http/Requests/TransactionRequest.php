<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'transaction_id' => 'required|string|unique:transactions',
            'user_id' => ['required','integer',Rule::exists(User::class,'id')],
            'amount' => 'required|numeric',
            'currency' => 'required|string',
            'status' => 'required|string',
            'message' => 'required|string',
        ];
    }
}
