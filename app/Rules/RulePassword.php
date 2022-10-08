<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RulePassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $username;
    public function __construct($username)
    {
        $this->username = $username;
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
        $i = 0;
        while ($i < strlen($value) - 3) {
            $cek_huruf = substr($value, $i, 3);
            if (str_contains($this->username, $cek_huruf)) {
                return false;
            }
            $i++;
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
        return 'Password tidak boleh mengandung 3 karakter berurutan dengan username!';
    }
}
