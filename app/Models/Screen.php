<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'sheet_id');
    }

    public static function checkReservation($schedule_id)
    {
        return self::withCount(['reservations' => function ($query) use ($schedule_id) {
            $query->where('schedule_id', $schedule_id);
        }]);
    }

    public function scopeScreeningNo($query, $screenNo)
    {
        return $query->where('screen_no', $screenNo);
    }
}
