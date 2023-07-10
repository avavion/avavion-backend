<?php

namespace App\Http\Requests\Project;

use App\Enums\ProjectSystemEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetFilteredProjectsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'per_page' => ['sometimes', 'integer', 'max:100'],
            'type' => ['required', Rule::enum(ProjectSystemEnum::class)],
            'page' => ['sometimes', 'integer', 'min:1']
        ];
    }
}
