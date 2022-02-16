<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'username' => 'required|string',
            'created_at' => 'required|date',
            'headline' => 'required|string',
            'description' => 'required|string',
            'photo' => 'required|mimes:jpg,jpeg,png'
        ];
    }
}
