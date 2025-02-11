<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $searchWord = $request->keyword;

        if (empty($searchWord) && is_null($request->is_showing)) {
            $movies = Movie::all();
            return view('movies', compact('movies'));
        }

        $searchedMovies = Movie::query();

        if (!empty($searchWord)) {
            $searchedMovies->where(function ($query) use ($searchWord) {
                $query->where('title', 'like', "%$searchWord%")
                    ->orWhere('description', 'like', "%$searchWord%");
            });
        }

        if (!is_null($request->is_showing)) {
            $searchedMovies->where('is_showing', $request->is_showing);
        }

        return view('movies', ['searchedMovies' => $searchedMovies->get()]);
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

    public function showMovie($id)
    {
        $movie = Movie::with(['schedules' => function ($query) {
            $query->orderBy('start_time');
        }])->find($id);
        return view('movie', compact('movie'));
    }

    public function showAdminMovie($id)
    {
        $movie = Movie::with('schedules')->find($id);
        return view('admin_movies_id', compact('movie'));
    }
}
