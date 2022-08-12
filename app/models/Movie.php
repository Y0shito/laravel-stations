<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image_url', 'published_year', 'is_showing', 'description'];

    public static function insert(array $value)
    {
        DB::beginTransaction();

        try {
            return Movie::create($value);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }
}
