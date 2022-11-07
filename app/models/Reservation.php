<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'schedule_id', 'sheet_id', 'email', 'name', 'created_at', 'updated_at'];

    public function Schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

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
}
