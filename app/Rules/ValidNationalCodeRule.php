<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidNationalCodeRule implements Rule
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
        if ($value == '') {
            $this->message = 'شماره ملی نباید خالی باشد';

            return false;
        }
        if (! is_numeric($value) && ! is_float($value)) {
            $this->message = 'شماره ملی باید عدد انگلیسی باشد';

            return false;
        }

        if (strlen($value) != 10) {
            $this->message = 'شماره ملی  ۱۰ رقم باید باشد';

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
