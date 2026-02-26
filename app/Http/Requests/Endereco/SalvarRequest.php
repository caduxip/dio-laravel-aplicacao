<?php

namespace App\Http\Requests\Endereco;

use Illuminate\Foundation\Http\FormRequest;

class SalvarRequest extends FormRequest
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
            'cep' => ['bail', 'required', 'string', 'regex:/^\d{5}-?\d{3}$/'],
            'logradouro' => ['bail', 'required', 'string', 'min:3', 'max:120'],
            'numero' => ['bail', 'required', 'string', 'min:1', 'max:10', 'regex:/^[0-9A-Za-z\-\/]+$/'],
            'bairro' => ['bail', 'required', 'string', 'min:2', 'max:80'],
            'cidade' => ['bail', 'required', 'string', 'min:2', 'max:80'],
            'estado' => ['bail', 'required', 'string', 'size:2', 'regex:/^[A-Za-z]{2}$/'],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute e obrigatorio.',
            'string' => 'O campo :attribute deve ser um texto.',
            'min' => 'O campo :attribute deve ter no minimo :min caracteres.',
            'max' => 'O campo :attribute deve ter no maximo :max caracteres.',
            'size' => 'O campo :attribute deve ter exatamente :size caracteres.',
            'cep.regex' => 'O campo CEP deve estar no formato 00000-000 ou 00000000.',
            'numero.regex' => 'O campo numero aceita apenas letras, numeros, "-" e "/".',
            'estado.regex' => 'O campo estado deve conter apenas 2 letras (UF).',
        ];
    }

    public function attributes()
    {
        return [
            'cep' => 'CEP',
            'logradouro' => 'logradouro',
            'numero' => 'numero',
            'bairro' => 'bairro',
            'cidade' => 'cidade',
            'estado' => 'estado',
        ];
    }
}
