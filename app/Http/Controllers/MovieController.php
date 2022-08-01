<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('movies', compact('movies'));
    }

    public function showAdmin()
    {
        $movies = Movie::all();
        return view('admin', compact('movies'));
    }


    public function showCreate()
    {
        return view('create');
    }

    public function showStore(MovieRequest $request)
    {
        return view('store');
    }
}
