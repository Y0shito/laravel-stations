<?php

namespace App\Providers;

use App\Models\Schedule;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extendImplicit('is_duplicate', function () {
            $request = request()->all();

            $start_time = "{$request['start_time_date']} {$request['start_time_time']}";
            $end_time = "{$request['end_time_date']} {$request['end_time_time']}";

            $isDuplicate = Schedule::isDuplicate($request['screen_no'], $start_time, $end_time);

            if ($isDuplicate) {
                return false;
            }
            return true;
        });

        Validator::extendImplicit('is_same_movie', function () {
            $request = request()->all();

            $start_time = "{$request['start_time_date']} {$request['start_time_time']}";
            $end_time = "{$request['end_time_date']} {$request['end_time_time']}";

            $isSameMovie = Schedule::isSameMovie($request['movie_id'], $start_time, $end_time);

            if ($isSameMovie) {
                return false;
            }
            return true;
        });
    }
}
