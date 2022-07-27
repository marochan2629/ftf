<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
        $rules = [];

        if (strpos($this->url(), 'question/create') !== false) {
            $rules['title'] = 'required|max:40';
            $rules['body'] = 'required|max:4000';
        }

        if (strpos($this->url(), 'question/answer') !== false) {
            $rules['answer'] = 'required|max:4000';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルを入力してください',
            'title.max' => 'タイトルは40文字以内で入力してください',
            'body.required' => '本文を入力してください',
            'body.max' => '本文は4000文字以内で入力してください',
            'answer.required' => '回答を入力してください',
            'answer.max' => '本文は4000文字以内で入力してください',
        ];
    }
}
