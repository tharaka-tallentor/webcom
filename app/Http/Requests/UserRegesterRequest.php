<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegesterRequest extends FormRequest
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
            "name" => ["required", "string", "max:255"],
            "email" => ["required", "email", "max:255", "regex:/(.+)@(.+)\.(.+)/i", "indisposable"],
            "password" => ["required", "min:5"],
            "confirm_password" => ["required", "same:password", "min:5"],
            "mobile" => ["required", "max:11:min:11", "numeric"],
            "position" => ["required", "string"]
        ];
    }
}
