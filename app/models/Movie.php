<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image_url', 'published_year', 'is_showing', 'description', 'created_at', 'updated_at'];

    public static function movieCreate(array $value)
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

    public static function movieUpdate($value)
    {
        DB::beginTransaction();

        try {
            self::find($value->id)->update([
                'title' => $value->title,
                'image_url' => $value->image_url,
                'published_year' => $value->published_year,
                'is_showing' => $value->is_showing,
                'description' => $value->description,
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            dd($e);
        }
    }

    public static function movieDelete($value)
    {
        DB::beginTransaction();

        $movie = self::find($value->id);

        if (is_null($movie)) {
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

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public static function getMoviesAndSchedules()
    {
        return self::with('schedules');
    }
}
