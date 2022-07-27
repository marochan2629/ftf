<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoRequest extends FormRequest
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
            'name' => 'required|max:30',
            'image' => 'required',
            'description' => 'max:600',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '写真のタイトルを入力してください',
            'name.max' => '写真のタイトルは30文字以内で入力してください',
            'image.required' => '写真を選択してください',
            'description.max' => '写真の説明は600文字以内で入力してください',
        ];
    }
}
