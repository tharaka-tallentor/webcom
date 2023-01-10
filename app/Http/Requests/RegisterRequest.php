<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "first_name" => ["required", "string", "max:255"],
            "last_name" => ["required", "string", "max:255"],
            "email" => ["required", "email", "regex:/(.+)@(.+)\.(.+)/i", "indisposable"],
            "mobile" => ["required", "regex:/^([0-9\s\-\+\(\)]*)$/", "min:10", "numeric"],
            "password" => ["required", "min:5"],
            "confirm_password" => ["required", "same:password", "min:5"]
        ];
    }
}
