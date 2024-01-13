<?php

namespace App\Http\Requests;

use App\Rules\GoogleCaptcha;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'login' => 'required|string|min:6|max:30',
            'password' => 'required|string|max:60',
            'g-recaptcha-response' => ['required', new GoogleCaptcha()]
        ];
    }

    public function messages()
    {
        return [
            'login.required' => 'Поле логин не может быть пустым',
            'login.string' => 'Поле логин имеет неверный формат',
            'login.min' => 'Поле логин должно быть не менее 6 символов',
            'login.max' => 'Поле логин превысило количество символов',
            'password.required' => 'Поле пароля не может быть пустым',
            'password.max' => 'Поле пароля превысило количество символов',
            'g-recaptcha-response.required' => 'Необходимо пройти проверку ReCaptcha',
        ];
    }
}
