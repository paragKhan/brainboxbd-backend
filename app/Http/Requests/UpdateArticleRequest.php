<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
            'category_id' => 'exists:categories,id',
            'username' => 'string',
            'created_at' => 'date',
            'headline' => 'string',
            'description' => 'string',
            'photo' => 'mimes:jpg,jpeg,png'
        ];
    }
}
