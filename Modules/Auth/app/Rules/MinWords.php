<?php

namespace Modules\Auth\app\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

class MinWords extends Rule implements ValidationRule
{

    public function __construct(private readonly int $minWords = 1){}

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if (count(explode(' ', $value)) < $this->minWords) {

            $fail('The :attribute must contain at least ' . $this->minWords . ' words.');
        }
    }

}
