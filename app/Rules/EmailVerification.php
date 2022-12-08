<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmailVerification implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $domain = explode('@', $value)[1] ?? null;

        if (!$domain) {
            return false;
        }

        if ($domain == 'gmail.com') {
            return true;
        }

        if ($domain == 'outlook.com') {
            return true;
        }

        if ($domain == 'hotmail.com') {
            return true;
        }

        if ($domain == 'info.com') {
            return true;
        }

        if ($domain == 'yahoo.com') {
            return true;
        }

        if ($domain == 'aol.com') {
            return true;
        }

        if ($domain == 'yandex.com') {
            return true;
        }

        if ($domain == 'yahoo.com') {
            return true;
        }

        if ($domain == 'yahoo.com') {
            return true;
        }

        if ($domain == 'yahoo.com') {
            return true;
        }

        if ($domain == 'yahoo.com') {
            return true;
        }

        if ($domain == 'yahoo.com') {
            return true;
        }

        if ($domain == 'yahoo.com') {
            return true;
        }

        if ($domain == 'yahoo.com') {
            return true;
        }

        if ($domain == 'yahoo.com') {
            return true;
        }

        if ($domain == 'yahoo.com') {
            return true;
        }

        if ($domain == 'yahoo.com') {
            return true;
        }

        if ($domain == 'yahoo.com') {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
