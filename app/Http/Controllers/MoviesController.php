<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;
use App\Movie;
use App\User;
use Auth;
use Storage;



class MoviesController extends Controller
{

    public function index()
    {
        $movies = Movie::all();
        $categories = Categories::orderBy('name')->get();
        return view('admin.movies',[
            'cats' => $categories,
            'movies' => $movies,
        ]);
    }

    public function movie_save( Request $request)
    {
        $categories = Categories::get();
        $user = Auth::user();
        $user->movies()->create($request->except('_token') + [
            'category_id' => $request->category,
            ]);

        return redirect()->route('admin.movies', ['cats' => $categories])->with('status', 'success');
    }
    public function movie_edit($id)
    {
        $categories = Categories::orderBy('name')->get();
        $movies = Movie::all();
        $data = $movies->where('id', $id)->first();

       return view('admin.movies',[
           'data' => $data,
           'movies' => $movies,
           'cats' => $categories,
           ]);
    }
    public function movie_update($id, Request $request)
    {

        Movie::findOrFail($id)->update($request->except('_token'));
        return redirect()->back()->with('status', 'updated');
    }
    public function movie_delete($id)
    {
        $movie = Movie::findOrFail($id);
        $images = $movie->image;
        foreach ($images as $image)
        {
            Storage::delete('public/image/'.$image->filename);
        }
        $movie->delete();
        return redirect()->back()->with('status', ' deleted');
    }
}
