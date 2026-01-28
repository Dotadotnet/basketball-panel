<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ExpireContractRule implements Rule
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
        if (strlen($value) != 4) {
            $this->message = 'تاریخ پایان قرارداد باید 4 رقم باشد';

            return false;
        }
        if (! preg_match("/\d{4}/", $value)) {
            $this->message = 'تاریخ پایان قرارداد باید مانند 1401 باشد';

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
