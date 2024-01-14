<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => 'required|min:6|max:60',
            'new_password' => 'required|confirmed|min:6|max:60',
        ];
    }

    public function messages()
    {
        return [
            'current_email.required' => 'Поле почты не может быть пустым',
            'current_email.email' => 'Поле почты неверного формата',
            'current_password.required' => 'Поле текущего пароля не может быть пустым',
            'current_password.min' => 'Поле текущего пароля должно быть не менее 6 символов',
            'current_password.max' => 'Поле текущего пароля превысило количество символов',
            'new_password.required' => 'Поле нового пароля не может быть пустым',
            'new_password.confirmed' => 'Пароли не совпадают',
            'new_password.min' => 'Поле нового пароля должно быть не менее 6 символов',
            'new_password.max' => 'Поле нового пароля превысило количество символов',
        ];
    }
}
