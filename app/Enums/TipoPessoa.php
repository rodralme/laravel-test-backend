<?php

namespace App\Enums;

class TipoPessoa extends BaseEnum
{
    const FISICA = 'fisica';
    const JURIDICA = 'juridica';

    public static function labels()
    {
        return [
            self::FISICA => 'Pessoa Física',
            self::JURIDICA => 'Pessoa Jurídica',
        ];
    }
}
