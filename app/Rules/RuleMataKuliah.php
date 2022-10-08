<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class RuleMataKuliah implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $listMataKuliah;
    public function __construct($listMataKuliah = [])
    {
        $this->listMataKuliah = $listMataKuliah;
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
        foreach ($this->listMataKuliah as $matkul) {
            if ($matkul['nama'] == $value) {
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
        return 'Nama mata kuliah harus unik!';
    }
}
