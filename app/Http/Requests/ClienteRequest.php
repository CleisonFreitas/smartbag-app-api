<?php

namespace App\Http\Requests;

class ClienteRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'senha' => ['required', 'string', 'max:255'],
            'ativo' => ['nullable', 'boolean']
        ];
    }
}
