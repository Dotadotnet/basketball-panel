<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidIdentityCodeRule implements Rule
{
    public string $message = '';

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
        if ($value == '' && $value == null) {
            $this->message = 'شماره شناسنامه نباید خالی باشد';

            return false;
        }
        if (! is_numeric($value) && ! is_float($value)) {
            $this->message = 'شماره شناسنامه باید عدد انگلیسی باشد';

            return false;
        }

        if (! (strlen($value) >= 1 || strlen($value) <= 10)) {
            $this->message = 'شماره شناسنامه بین ۱ الی ۱۰ رقم باید باشد';

            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
