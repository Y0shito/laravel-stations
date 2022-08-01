<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:30'],
            'image_url' => ['required', 'url', 'max:2000'],
            'published_year' => ['required', 'numeric', 'between:1895,2022'],
            'description' => ['required', 'string', 'max:100',],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルを入力してください',
            'title.max' => 'タイトルは30文字以内で入力してください',
            'image_url.required' => '有効なURLで入力してください',
            'image_url.url' => '有効なURLで入力してください',
            'published_year.required' => '公開日を入力してください',
            'published_year.numeric' => '公開日を数字で入力してください',
            'published_year.between' => '公開日を1895から2022の間で入力してください',
            'description.required' => '概要を入力してください',
            'description.max' => '概要は100文字以内で入力してください',
        ];
    }
}
