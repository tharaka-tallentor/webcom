<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            "name" => ["required", "string"],
            "mobile" => ["required", "numeric", "regex:/^([0-9\s\-\+\(\)]*)$/", "min:10"],
            "tel" => ["required", "numeric", "regex:/^([0-9\s\-\+\(\)]*)$/", "min:10"],
            "email" => ["required", "email", "regex:/(.+)@(.+)\.(.+)/i"],
            "address" => ["required"],
            "avatar" => ["mimes:jpeg"],
            "web" => ["required", "regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i"],
            "fb_page" => ["required", "regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i"],
            "country" => ["required", "numeric"],
            "industry" => ["required", "numeric"]
        ];
    }
}
