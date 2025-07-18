<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_en' => ['required', 'string', 'max:256', 'min:4'],
            'name_ar' => ['required', 'string', 'max:256', 'min:4'],
            'status' => ['required', 'integer', 'between:0,1'],
            'img' => ['required', 'max:1000', 'mimes:png,jpg,jpeg']
        ];
    }
}
