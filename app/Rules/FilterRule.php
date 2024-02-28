<?php
//01015827255
namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FilterRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
}
