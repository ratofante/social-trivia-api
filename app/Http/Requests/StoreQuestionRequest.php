<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
            'question' => 'string',
            'answer' => 'string',
            'opt_1' => 'nullable|string',
            'opt_2' => 'nullable|string',
            'opt_3' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id'
        ];
    }
}
