<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CNPJValidoRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        // Verifica se um número foi informado
        if (is_null($value) || $value == '') {
            // deixa a validação passar pois pode ser um campo não obrigatório
            return true;
        }

        // Elimina possivel mascara
        $cnpj = preg_replace("/[^0-9]/", "", $value);
        $cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);

        // Verifica se o numero de digitos informados é igual a 14
        if (strlen($cnpj) != 14) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos.
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }

        // Calcula os digitos verificadores para verificar se o CNPJ é valido
        $soma = 0;
        $multiplicador = 0;

        // PEGA A PRIMEIRA PARTE DO CNPJ, SEM OS DÍGITOS VERIFICADORES
        $parte1 = substr($cnpj, 0, 12);

        // INVERTE A 1ª PARTE DO CNPJ PARA CONTINUAR A VALIDAÇÃO
        $parte1_invertida = strrev($parte1);

        // PERCORRENDO A PARTE INVERTIDA PARA OBTER O FATOR DE CALCULO DO 1º DÍGITO VERIFICADOR
        for ($i = 0; $i <= 11; $i++) {
            $multiplicador = ($i == 0) || ($i == 8) ? 2 : $multiplicador;

            $multiplo = ($parte1_invertida[$i] * $multiplicador);

            $soma += $multiplo;

            $multiplicador++;
        }

        // OBTENDO O 1º DÍGITO VERIFICADOR
        $rest = $soma % 11;

        $dv1 = ($rest == 0 || $rest == 1) ? 0 : 11 - $rest;

        // PEGA A PRIMEIRA PARTE DO CNPJ CONCATENANDO COM O 1º DÍGITO OBTIDO
        $parte1 .= $dv1;

        // MAIS UMA VEZ INVERTE A 1ª PARTE DO CNPJ PARA CONTINUAR A VALIDAÇÃO
        $parte1_invertida = strrev($parte1);

        $soma = 0;

        // MAIS UMA VEZ PERCORRE A PARTE INVERTIDA PARA OBTER O FATOR DE CALCULO DO 2º DÍGITO VERIFICADOR
        for ($i = 0; $i <= 12; $i++) {
            $multiplicador = ($i == 0) || ($i == 8) ? 2 : $multiplicador;

            $multiplo = ($parte1_invertida[$i] * $multiplicador);

            $soma += $multiplo;

            $multiplicador++;
        }

        // OBTENDO O 2º DÍGITO VERIFICADOR
        $rest = $soma % 11;

        $dv2 = ($rest == 0 || $rest == 1) ? 0 : 11 - $rest;

        // AO FINAL COMPARA SE OS DÍGITOS OBTIDOS SÃO IGUAIS AOS INFORMADOS (OU A SEGUNDA PARTE DO CNPJ)
        return ($dv1 == $cnpj[12] && $dv2 == $cnpj[13]) ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'CNPJ inválido.';
    }
}
