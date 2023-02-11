<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            'movie_id' => ['required'],
            'screen_no' => ['required'],
            'start_time_date' => ['required', 'date_format:Y-m-d', 'is_duplicate', 'is_same_movie'],
            'start_time_time' => ['required', 'date_format:H:i', 'is_duplicate', 'is_same_movie'],
            'end_time_date' => ['required', 'date_equals:start_time_date', 'date_format:Y-m-d', 'is_duplicate', 'is_same_movie'],
            'end_time_time' => ['required', 'after:start_time_time', 'date_format:H:i', 'is_duplicate', 'is_same_movie'],
        ];
    }

    public function messages()
    {
        return [
            'movie_id.required' => 'IDに値がありません',
            'screen_no.required' => 'スクリーンNoを入力してください',
            'start_time_date.required' => '日付を入力してください',
            'start_time_time.required' => '時間を入力してください',
            'end_time_date.required' => '日付を入力してください',
            'end_time_date.date_equals' => '公開日が一致しません',
            'end_time_time.required' => '時間を入力してください',
            'end_time_time.after' => '開始時間より後の時間を指定してください',
        ];
    }
}
