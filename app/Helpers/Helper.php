<?php

namespace App\Helpers;

class Helper
{
    public static function generateFiveDigitCodeWithZero() {
        $digits = '123456789'; // رقم اول نمی‌تونه صفر باشه
        $otherDigits = '0123456789';

        $code = $digits[rand(0, strlen($digits) - 1)];

        for ($i = 0; $i < 4; $i++) {
            $code .= $otherDigits[rand(0, strlen($otherDigits) - 1)];
        }

        if (strpos($code, '0') === false) {
            $pos = rand(1, 4); 
            $code[$pos] = '0';
        }

        return $code;
    }
}

