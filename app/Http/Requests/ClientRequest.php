<?php

namespace App\Http\Requests;

use App\Client;
use Illuminate\Foundation\Http\FormRequest;
use PhpParser\Node\Scalar\String_;

class ClientRequest extends FormRequest
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
        $pessoa = Client::getPessoa($this->get('pessoa'));
        $documentType = $pessoa == Client::PESSOA_FISICA ? 'cpf' : 'cnpj';
        $id = $this->route('client');
        $rules = [
            'nome' => 'required|max:100',
            'documento' => "required|documento:$documentType|unique:clients,documento, $id",
            'email' => 'required|email',
            'telefone'=> 'required',

        ];
        if ($pessoa == Client::PESSOA_FISICA){
            $estadosCivis = implode(',',array_keys(Client::ESTADOS_CIVIS));
            $rules = array_merge($rules,[
                'date_nasc' => 'required|date_format:d/m/Y',
                'estado_civil' => "required|in:$estadosCivis",
                'sexo' => 'required|in:m,f'
                ]);
        }else{
            $rules = array_merge($rules,[
               'fantasia'=> 'required',
            ]);
        }

         return $rules;

    }

    /**
     * @return array
     */
    public function  messages()
        {
            $pessoa = Client::getPessoa($this->get('pessoa'));

            if ($pessoa == Client::PESSOA_FISICA)
            {
                $document = 'Favor informar CPF';
                $valid = 'CPF nao e valido';
            }else
            {
                $document = 'Favor informar CNPJ';
                $valid = 'CNPJ nao e valido';
            }
            return [
                'nome.required' => "O campo nome e requerido",
                'nome.max' => 'O campo nome nao permite mais de 40 caracteres',
                'documento.required'=> $document,
                'documento.documento' => $valid,
                'documento.unique' => 'O documento já está sendo utilizado',
                'telefone.required'=> 'O campo telefone e requerido',
                'email.required'=> 'O campo e-mail e requerido',
                'fantasia.required'=> 'O campo nome fantasia e requerido',
                'date_nasc.required'=> 'O campo data de nascimento e requerido',

            ];
        }
}
