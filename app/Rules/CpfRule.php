<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CpfRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $value);

        // Verifica se o CPF tem 11 dígitos
        if (strlen($cpf) !== 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            $fail("O campo {$attribute} não é um CPF válido.");
            return;
        }

        // Valida os dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                $fail("O campo {$attribute} não é um CPF válido.");
                return;
            }
        }
    }
}
