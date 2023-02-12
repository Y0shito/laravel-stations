<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password'];

    public static function userStoreOnModel(array $value)
    {
        DB::beginTransaction();

        try {
            self::create([
                'name' => $value['name'],
                'email' => $value['email'],
                'password' => Hash::make($value['password']),
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw new Exception($e);
        }
    }
}