<?php

namespace App\Http\Requests\Article;

use App\Exceptions\ApiException;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->tokenCan('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'min:10'],
            'image' => ['required', 'image', 'max:10240'],
            'isPublished' => ['nullable']
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
