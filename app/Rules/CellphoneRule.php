<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CellphoneRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public string $message = '';

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
            $this->message = 'شماره موبایل نباید خالی باشد';

            return false;
        }

        if (! is_numeric($value) && ! is_float($value)) {
            $this->message = 'شماره موبایل باید عدد انگلیسی باشد';

            return false;
        }
        if (strlen($value) != 11) {
            $this->message = 'شماره موبایل 11 رقم باید باشد';

            return false;
        }
//        if(startsWith($value, "09")){
//            $this->message = 'شماره موبایل 09 شروع شود';
//            return false;
//        }

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
