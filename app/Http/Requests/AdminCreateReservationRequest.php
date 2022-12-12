<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCreateReservationRequest extends FormRequest
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
            'screening_date' => ['required', 'date_format:Y-m-d'],
            'movie_id' => ['required'],
            'schedule_id' => ['required'],
            'sheet_id' => ['required'],
            'email' => ['required', 'email'],
            'name' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'screening_date.required' => '上映日が選択されていません',
            'movie_id' => '映画が選択されていません',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '有効なメールアドレスではありません',
            'name.required' => '氏名を入力してください',
            'name.string' => '有効な氏名ではありません',
        ];
    }
}