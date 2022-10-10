<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Schedule extends Model
{
    use HasFactory;

    protected $dates = ['start_time_date', 'start_time_time', 'end_time_date', 'end_time_time'];

    public static function scheduleDelete($value)
    {
        DB::beginTransaction();

        $schedule = self::find($value->id);

        if (is_null($schedule)) {
            return abort(404);
        }

        try {
            self::destroy($value->id);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            dd($e);
        }
    }
}
