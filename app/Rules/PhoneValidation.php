<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $regex = "/^(01)[0125][0-9]{8}$/";
        if (! (bool)preg_match($regex, $value)) {
            $fail('The'.$attribute.'is invalid.');
        }
    }
}
