<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
            "f_name" => ["required", "string"],
            "l_name" => ["required", "string"],
            "email" => ["required", "email", "max:255", "regex:/(.+)@(.+)\.(.+)/i", "indisposable"],
            "mobile" => ["required", "regex:/^([0-9\s\-\+\(\)]*)$/", "min:10", "numeric"]
        ];
    }
}
