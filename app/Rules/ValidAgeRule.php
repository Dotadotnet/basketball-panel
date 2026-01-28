<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidAgeRule implements Rule
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
            $this->message = 'تاریخ تولد نباید خالی باشد';

            return false;
        }
        if (strlen($value) != 10) {
            $this->message = 'تاریخ تولد باید 10 رقم باشد';

            return false;
        }
        if (! preg_match("/\d{4}\/\d{2}\/\d{2}/", $value)) {
            $this->message = 'تاریخ تولد باید مانند 1401/01/09 باشد';

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
