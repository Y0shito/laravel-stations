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
            $movie = Movie::create($value);
            DB::commit();

            return $movie;
        } catch (Exception $e) {
            DB::rollback();
            dd($e);
        }
    }

    public static function movieUpdate(array $value)
    {
        DB::beginTransaction();

        try {
            $movie = self::find($value['id']);
            $movie->update($value);
            DB::commit();

            return $movie;
        } catch (Exception $e) {
            DB::rollback();
            dd($e);
        }
    }
}
