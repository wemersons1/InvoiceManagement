<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Cnpj implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cnpjIsValid = false;
    
        $cnpj = preg_replace('/[^0-9]/', '', (string) $value);

        if (strlen($cnpj) != 14) {
            $cnpjIsValid = false;
        }

        // Verifique a validade do CNPJ
        $tamanho = strlen($cnpj) - 2;
        $numbers = substr($cnpj, 0, $tamanho);
        $digitoVerificador = substr($cnpj, $tamanho);

        $soma = 0;
        $pos = $tamanho - 7;
        for ($i = $tamanho; $i >= 1; $i--) {
            $soma += $numbers[$tamanho - $i] * $pos--;
            if ($pos < 2) {
                $pos = 9;
            }
        }

        $resultado = ($soma % 11 < 2) ? 0 : 11 - ($soma % 11);

        $cnpjIsValid = $resultado == $digitoVerificador[0];

        if (!$cnpjIsValid) {
            $fail(':attribute inválido.');
        }
    }
}
