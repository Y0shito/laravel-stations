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

    public function store(MovieRequest $request, Movie $value)
    {
        $movie = $value->movieCreate($request->all());
        return redirect()->route('showStore');
    }

    public function showStore()
    {
        return view('store');
    }

    public function edit(Movie $id)
    {
        return view('edit', ['movie' => $id]);
    }

    public function update(MovieRequest $request, Movie $value)
    {
        $movie = $value->movieUpdate($request);
        return redirect()->route('showStore');
    }
}
