<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RuleNomorTelepon implements Rule
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
        foreach ($this->listUser as $user) {
            if ($user['nomor'] == $value) {
                return false;
            }
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
        return 'Nomor telepon harus unik!';
    }
}
