<?php

namespace App\Http\Requests\Article;

use App\Exceptions\ApiException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->tokenCan('admin');
    }

    public function rules(): array
    {
        return [
            'articleId' => ['required', 'integer', 'exists:articles,id']
        ];
    }

    /**
     * @throws ApiException
     */
    public function failedValidation(Validator $validator)
    {
        throw new ApiException($validator->errors()->first(), 400);
    }

}
