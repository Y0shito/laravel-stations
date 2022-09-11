<?php

namespace App\Http\Controllers;

use Exception;
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
        $movie = $value->movieCreate($request
            ->only(['id', 'title', 'image_url', 'published_year', 'is_showing', 'description']));

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

    public function delete(Request $request, Movie $value)
    {
        $movie = $value->movieDelete($request);

        return redirect()->route('adminMovies')
            ->with(['message' => '選択した映画が削除されました']);
    }
}
