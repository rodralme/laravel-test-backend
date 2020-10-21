<?php

namespace App\Http\Controllers;

use App\Enums\TipoPessoa;
use App\Enums\UF;

class IndexController extends Controller
{
    public function __invoke()
    {
        $enums = [
            'UF' => UF::getCombo(),
            'TipoPessoa' => TipoPessoa::getCombo(),
        ];

        return view('index', compact('enums'));
    }
}
