<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminEditReservationRequest extends FormRequest
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
            'id' => ['required'],
            'schedule_id' => ['required'],
            'screening_date' => ['required'],
            'sheet_id' => ['required'],
            'email' => ['required', 'email'],
            'name' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'id.required' => '予約IDか指定されていません',
            'schedule_id.required' => 'スケジュールIDが指定されていません',
            'screening_date.required' => '公開日時が指定されていません',
            'sheet_id.required' => '座席が選択されていません',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => '有効なメールアドレスではありません',
            'name.required' => '氏名を入力してください',
            'name.string' => '有効な氏名ではありません',
        ];
    }

    protected function getRedirectUrl()
    {
        return route('adminReservations');
    }
}
