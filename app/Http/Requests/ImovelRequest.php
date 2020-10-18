<?php

namespace App\Http\Requests;

use App\Enums\UF;
use Illuminate\Foundation\Http\FormRequest;

class ImovelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email_proprietario' => 'required|email',
            'rua' => 'required',
            'numero' => 'sometimes',
            'complemento' => 'sometimes',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required|in:' . join(',', UF::values()),
        ];
    }
}