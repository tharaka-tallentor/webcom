<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TempLoginRequest extends FormRequest
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
            "email" => ["required", "email", "max:255", "regex:/(.+)@(.+)\.(.+)/i", "indisposable"],
            "otp" => ["required", "max:5", "numeric"]
        ];
    }
}
