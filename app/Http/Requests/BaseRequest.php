<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class BaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator): void
    {
        if ($validator->fails()) {
            throw new HttpResponseException(
                response()->json([
                    'message' => 'Erro durante validação.',
                    'errors' => $validator->errors(),
                ], Response::HTTP_UNPROCESSABLE_ENTITY)
            );
        }
    }

    /**
     *
     * @return array<string,
     */
    public function rules(): array
    {
        return [];
    }
}
