<?php

namespace App\Models;

use Exception;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['screening_date', 'schedule_id', 'sheet_id', 'email', 'name', 'created_at', 'updated_at'];
    protected $dates = ['screening_date'];

    protected static function booted()
    {
        static::addGlobalScope('released_reservation', function (Builder $builder) {
            $builder->whereDate('screening_date', '>', CarbonImmutable::yesterday());
        });
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function sheet()
    {
        return $this->belongsTo(Screen::class, 'sheet_id');
    }

    public static function reserveStoreOnModel(array $value)
    {
        DB::beginTransaction();

        try {
            self::create($value);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception($e);
        }
    }

    public static function reservationUpdateOnModel(array $value)
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

    public static function ReservationDeleteOnModel($value)
    {
        DB::beginTransaction();

        $Reservation = self::find($value->id);

        if (is_null($Reservation)) {
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
