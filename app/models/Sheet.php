<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    use HasFactory;

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public static function checkReservation($schedule_id)
    {
        return self::withCount(['reservations' => function ($query) use ($schedule_id) {
            $query->where('schedule_id', $schedule_id);
        }]);
    }
}
