<?php

namespace App\Http\Controllers;

use Acme\Repos\Movie;
use Acme\Repos\JsonMovieRepository;
use App\Http\Requests\SearchMovieRequest;

class MovieController extends Controller
{
    protected $movies;

    /**
     * MovieController constructor.
     */
    public function __construct()
    {
        $this->movies = new JsonMovieRepository();
        $this->movies->init("https://pastebin.com/raw/cVyp3McN");
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * @param SearchMovieRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(SearchMovieRequest $request)
    {
        $movies = $this->movies
            ->sortRatings()
            ->genre($request->input('genre'))
            ->showingNext($request->input('showing'))
            ->display($request->input('showing'))
        ;
        $movies = ($movies != null ) ? $movies : ["no movie recommendations"];

        return view('index', compact('movies'));
    }


}
