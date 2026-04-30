<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RutChileno implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $rut = preg_replace('/[^kK0-9]/', '', $value);
        if (strlen($rut) < 2) {
            $fail('El RUT ingresado no es válido.');
            return;
        }

        $body = substr($rut, 0, -1);
        $dv = strtoupper(substr($rut, -1));

        $sum = 0;
        $factor = 2;

        for ($i = strlen($body) - 1; $i >= 0; $i--) {
            $sum += $factor * intval($body[$i]);
            $factor = $factor == 7 ? 2 : $factor + 1;
        }

        $expectedDv = 11 - ($sum % 11);
        $expectedDv = $expectedDv == 11 ? '0' : ($expectedDv == 10 ? 'K' : (string)$expectedDv);

        if ($dv !== $expectedDv) {
            $fail('El RUT ingresado no es válido.');
        }
    }
}
