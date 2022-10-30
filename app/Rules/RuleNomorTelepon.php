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
    public $tipe;
    public function __construct($listUser, $tipe)
    {
        $this->listUser = $listUser;
        $this->tipe = $tipe;
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
            if ($this->tipe == "dosen") {
                if ($user->dosen_telepon == $value) {
                    return false;
                }
            } else {
                if ($user->mahasiswa_telepon == $value) {
                    return false;
                }
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
