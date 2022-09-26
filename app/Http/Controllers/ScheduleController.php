<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function showSchedules()
    {
        $movies = Movie::getMoviesAndSchedules()->get();
        // dd($movies);
        return view('schedules', compact('movies'));
    }
}
