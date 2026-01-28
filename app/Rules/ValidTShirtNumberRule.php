<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidTShirtNumberRule implements Rule
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
//        if(!is_numeric($value) && !is_float($value)){
//            $this->message = 'شماره پیراهن باید عدد انگلیسی باشد';
//            return false;
//        }

        if (! (strlen($value) >= 1 || strlen($value) <= 2)) {
            $this->message = 'شماره پیراهن می‌تواند بین اعداد 1 الی 99 باشد';

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
