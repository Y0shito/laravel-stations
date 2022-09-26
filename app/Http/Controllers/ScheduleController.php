<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function showSchedules()
    {
        $movies = Movie::getMoviesAndSchedules()->get();
        return view('schedules', compact('movies'));
    }

    public function showScheduleManage($id)
    {
        $movie = Movie::getMoviesAndSchedules()->whereId($id)->first();
        return view('schedule_Manage', compact('movie'));
    }
}
