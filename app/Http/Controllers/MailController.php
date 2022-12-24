<?php

namespace App\Http\Controllers;

use App\Mail\SignupEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendSignupEmail($name, $email, $otp)
    {
        $data = [
            'name' => $name,
            'otp' => $otp
        ];
        Mail::to($email)->send(new SignupEmail($data));
    }
}
