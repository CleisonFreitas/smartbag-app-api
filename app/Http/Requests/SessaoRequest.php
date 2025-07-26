<?php

namespace App\Http\Requests;

use App\Enums\SegmentoEnum;
use App\Enums\SessaoStatusEnum;
use Illuminate\Validation\Rule;

class SessaoRequest extends BaseRequest
{
    public function rules(): array
    {
        /**
         * @inheritDoc
         */
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'status' => ['nullable', 'string', Rule::in(SessaoStatusEnum::cases())],
            'segmento' => [
                Rule::in(SegmentoEnum::cases()),
                Rule::requiredIf(is_null($this->id))
            ],
            'previsao' => ['nullable', 'date'],
        ];
    }
}
