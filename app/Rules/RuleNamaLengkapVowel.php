<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RuleNamaLengkapVowel implements Rule
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
        preg_match_all("/[aeiou]/i", $value, $matches);

        if (count($matches[0]) >= 3) {
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
        return 'Nama lengkap mahasiswa minimal memiliki 3 vowel (a, e, i, o, u)!';
    }
}
