<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeEmailRequest extends FormRequest
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
            'current_email' => 'required|email',
            'new_email' => 'required|email|unique:users,email'
        ];
    }

    public function messages()
    {
        return [
            'current_email.required' => 'Поле почты не может быть пустым',
            'current_email.email' => 'Поле почты неверного формата',
            'new_email.required' => 'Поле новой почты не может быть пустым',
            'new_email.email' => 'Поле новой почты неверного формата',
            'new_email.unique' => 'Электронная почта привязана к другому аккаунту',
        ];
    }
}
