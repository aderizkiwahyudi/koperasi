<?php

namespace App\Rules;

use App\Models\Settings;
use Illuminate\Contracts\Validation\Rule;

class MaxLengtOfLoan implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->setting = Settings::first();
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
        return $value < $this->setting->max_length_of_loan;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Maksimal tenor yang bisa diajukan adalah ' . $this->setting->max_length_of_loan;
    }
}
