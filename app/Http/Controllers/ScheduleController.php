<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Schedule;
use App\Http\Requests\ScheduleRequest;
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

    public function scheduleCreate(Movie $id)
    {
        return view('schedule_create', ['movie' => $id]);
    }

    public function scheduleStore(ScheduleRequest $request, Schedule $value)
    {
        $schedule = [
            'movie_id' => $request->movie_id,
            'start_time' => "$request->start_time_date $request->start_time_time",
            'end_time' => "$request->end_time_date $request->end_time_time",
        ];

        $schedule = $value->scheduleStoreOnModel($schedule);
        return redirect()->route('scheduleManage', ['id' => $request->movie_id]);
    }

    public function scheduleDelete(Request $request, Schedule $value)
    {
        $schedule = $value->scheduleDeleteOnModel($request);
        return back();
    }
}
