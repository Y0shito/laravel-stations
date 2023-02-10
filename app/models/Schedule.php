<?php

namespace App\Models;

use Exception;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'screen_no', 'movie_id', 'start_time', 'end_time'];
    protected $dates = ['start_time', 'end_time'];

    protected static function booted()
    {
        static::addGlobalScope('released_schedule', function (Builder $builder) {
            $builder->whereDate('start_time', '>', CarbonImmutable::yesterday());
        });
    }

    public static function scheduleStoreOnModel(array $value)
    {
        DB::beginTransaction();

        try {
            self::create($value);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            dd($e);
        }
    }

    public static function scheduleUpdateOnModel(array $value)
    {
        DB::beginTransaction();

        try {
            self::find($value['id'])->update($value);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            dd($e);
        }
    }

    public static function scheduleDeleteOnModel($value)
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

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public static function isDuplicate($screen_no, $start_time, $end_time)
    {
        if (self::withoutGlobalScope('released_schedule')
            ->where('screen_no', $screen_no)
            ->where('start_time', '<=', $end_time)
            ->where('end_time', '>=', $start_time)
            ->exists()
        ) {
            return true;
        }
        return false;
    }

    public static function isSameMovie($movie_id, $start_time, $end_time)
    {
        if (self::withoutGlobalScope('released_schedule')
            ->where('start_time', '<=', $end_time)
            ->where('end_time', '>=', $start_time)
            ->where('movie_id', $movie_id)
            ->exists()
        ) {
            return true;
        }
        return false;
    }
}
