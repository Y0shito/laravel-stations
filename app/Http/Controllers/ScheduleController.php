<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Schedule;
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

    public function scheduleDelete(Request $request, Schedule $value)
    {
        $schedule = $value->scheduleDelete($request);
        return back();
    }
}
