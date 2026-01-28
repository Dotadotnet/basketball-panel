<?php

namespace App\Rules;

use App\Models\FilesConfiguration;
use Illuminate\Contracts\Validation\Rule;

class AuthorizedFilesConfigurationRule implements Rule
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

    public string $message = '';

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $files_config = FilesConfiguration::select('id', 'mime_type', 'extension', 'max_size')->get();
        $extension = $value->getClientOriginalExtension();
        $size = $value->getSize();
        $matchedExtension = false;
        $this->message = '';
        $control = 0;

        foreach ($files_config as $config) {
            // authorized extension
            if ($config->extension == $extension) {
                $matchedExtension = true;
                // authorized size file
                if ($size > $config->max_size) {
                    $this->message = '.حجم فایل بیشتر از '.(int) $config->max_size / 1024 / 1024 .'مگابایت است';
                    $control = 1;
                }
            }
        }
        if (! $matchedExtension) {
            $this->message .= '.مجاز نمی‌باشد '.$extension.' پسوند';
            $control = 2;
        }
        if ($control != 0) {
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
