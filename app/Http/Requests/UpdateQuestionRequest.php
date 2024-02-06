<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
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
            'question' => 'string|unique:questions|max:191',
            'answer' => 'string|max:255',
            'opt_1' => 'string|max:255',
            'opt_2' => 'string|max:255',
            'opt_3' => 'string|max:255'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'question.unique' => 'There is an identical question on the game already',
            'question.required' => 'A title is required',
            'question.max' => 'the question is too long', 
            'answer.string' => 'The answer should be a string.',
        ];
    }
}
