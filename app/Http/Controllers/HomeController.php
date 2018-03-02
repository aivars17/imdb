<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;
use App\Movie;
use Auth;
use Response;
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
        $movies = Movie::paginate(8);
        $cateogries = Categories::all();

        return view('welcome', ['movies' => $movies, 'categories' => $cateogries]);
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
        $actors = $movie->actor;
        $movies_by_category= $movie->category->movies;


        return view('movies.single', ['movie' => $movie, 'actors' => $actors, 'movies_by_category' => $movies_by_category,]);
    }

    public function orderby(Request $request)
    {

        if($request->rating <= 10){
            if($request->rating == 0){
                $max = 10;
            }else{
                $max = $request->rating + 1;
            }
        }else{
            $max = 10;
        }
        if($request->category == 'all'){
            $movies = Movie::orderByRaw('name ' . $request->a_z, 'year ' . $request->year)->whereBetween('rating',[$request->rating, $max])->paginate(10)->get();
            $orderby_category = 'all';
        }else{
            $category = Categories::findOrFail($request->category);
            if($category->movies->first() == null){
                session()->flash('error', 'No movies in this category');
            };
            $movies = $category->movies()->orderBy('name', $request->a_z)->orderBy('year', $request->year)->whereBetween('rating',[$request->rating, $max])->paginate(10);
            $orderby_category = $category->name;
        }
        $categories = Categories::all();

        $request->session()->put(['orderby_category' => $orderby_category, 'orderby_a_z' => $request->a_z, 'orderby_year' => $request->year, 'orderby_rating' => $request->rating]);
        return view('welcome', ['moviesM' => $movies, 'categories' => $categories]);
    }


    public function test(Request $request)
    {


        return view('autocomplete');

//        $movie = Movie::where('name', 'like', '%' . $request->id . '%')->get();
//        return $movie;
    }

    public function ajaxData(Request $request){

        $query = $request->get('query','');

        $posts = Post::where('name','LIKE','%'.$query.'%')->get();

        return response()->json($posts);

    }
}
