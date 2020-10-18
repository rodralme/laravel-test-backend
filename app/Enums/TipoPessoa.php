<?php

namespace App\Enums;

class TipoPessoa extends BaseEnum
{
    const FISICA = 'fisica';
    const JURIDICA = 'juridica';

    public static function labels()
    {
        return [
            self::FISICA => 'Física',
            self::JURIDICA => 'Jurídica',
        ];
    }
}
