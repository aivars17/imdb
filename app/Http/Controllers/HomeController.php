<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all();

        return view('welcome', ['movies' => $movies]);
    }
    public function home()
    {
        if(Auth::user()->role == 'admin')
        {
            return view('admin.dashboard');
        }
        $movies = Movie::all();

        return view('welcome', ['movies' => $movies]);
    }

    public function single_movie($id)
    {

        $movie = Movie::findOrFail($id);
        return view('movies.single', ['movie' => $movie]);
    }
}
