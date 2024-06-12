<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use Illuminate\Translation\Translator;

class LatinSpaceDashRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        $translator = app(Translator::class);

        if (!preg_match('/^[a-zA-Z\s\-–—]*$/u', $value)) {
            $errorMessage = "{$attribute} должно содержать только латинские буквы, пробелы и тире.";

            $translatedError = new PotentiallyTranslatedString($errorMessage, $translator);

            $fail($translatedError);
        }
    }
}
