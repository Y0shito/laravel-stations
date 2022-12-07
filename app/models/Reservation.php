<?php

namespace App\Models;

use Exception;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['screening_date', 'schedule_id', 'sheet_id', 'email', 'name', 'created_at', 'updated_at'];
    protected $dates = ['screening_date'];

    public function Schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    //Sが大文字になっている

    public function sheet()
    {
        return $this->belongsTo(Sheet::class);
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

    public function scopeWithoutReleased($query)
    {
        $query->whereDate('screening_date', '>', CarbonImmutable::now());
    }
}
