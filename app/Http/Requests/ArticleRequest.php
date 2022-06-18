<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required|max:50',
            'body' => 'required|max:3000',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルを入力してください',
            'title.max' => 'タイトルは50文字以内で入力してください',
            'body.required' => '本文を入力してください',
            'body.max' => '本文は3000文字以内で入力してください',
        ];
    }
}
