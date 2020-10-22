<?php

namespace App\Http\Requests;

use App\Enums\TipoPessoa;
use App\Models\Contrato;
use App\Rules\CNPJValidoRule;
use App\Rules\CPFValidoRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ContratoRequest extends FormRequest
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
            'imovel_id' => 'required',
            'tipo_pessoa' => 'required|in:' . join(',', TipoPessoa::values()),
            'documento' => [
                'required',
                $this->input('tipo_pessoa') === TipoPessoa::FISICA
                    ? new CPFValidoRule() : new CNPJValidoRule(),
            ],
            'email_contratante' => 'required|email',
            'nome_contratante' => 'required',
        ];
    }

    /**
     * Validações customizadas.
     *
     * @param \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function (Validator $validator) {
            if (Contrato::where('imovel_id', $this->input('imovel_id'))->exists()) {
                $validator->errors()->add('imovel_contratado', 'Imovél já contratado');
            }
        });
    }
}
