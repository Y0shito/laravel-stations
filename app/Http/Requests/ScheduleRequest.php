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
            'start_time_date' => ['required', 'date_format:Y-m-d'],
            'start_time_time' => ['required', 'date_format:H:i'],
            'end_time_date' => ['required', 'date_format:Y-m-d'],
            'end_time_time' => ['required', 'date_format:H:i'],
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
            'end_time_time.required' => '時間を入力してください',
        ];
    }
}
