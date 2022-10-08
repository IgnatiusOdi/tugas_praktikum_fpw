<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RuleLogin implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $listUser;
    public function __construct($listUser = [])
    {
        $this->listUser = $listUser;
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
        if ($value == "admin") return true;

        foreach ($this->listUser as $user) {
            if ($user['username'] == $value) {
                return true;
            }
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
        return 'User belum terdaftar!';
    }
}
