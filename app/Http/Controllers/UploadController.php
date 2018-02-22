<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Actor;
use App\Movie;
use App\Categories;

class UploadController extends Controller
{
    public function index($id, $img_category)
    {
        return view('admin.upload', ['id' => $id, 'img_category' => $img_category]);
    }
    public function actor_image_store($id, Request $request)
    {
        $file = $request->file('input25');
        $path = $file->storePublicly('public/image');
        $filename = basename($path);
        $user = Auth::user();
        $actor = Actor::findOrFail($id);
        $actor->image()->create($request->except('_token') + [
            'filename' => $filename,
                'user_id' => $user->id,
            ]);

        session()->flash('status', 'Image upload successful');

        if($user->role == 'admin'){
            return redirect()->route('actors');
        }
        return redirect()->route('single_actor', [$id,$actor->name]);
    }
    public function movie_image_store($id, Request $request)
    {
        $file = $request->file('input25');
        $path = $file->storePublicly('public/image');
        $filename = basename($path);
        $user = Auth::user();
        $movie = Movie::findOrFail($id);
        $movie->image()->create($request->except('_token') + [
                'filename' => $filename,
                'user_id' => $user->id,
            ]);
        session()->flash('status', 'Image upload successful');
        $movies = Movie::all();
        $categories = Categories::all();

        if($user->role == 'admin'){
            return view('admin.movies',[
                'cats' => $categories,
                'movies' => $movies,
            ]);
        }
        return redirect()->route('single_movie', [$id,$movie->name]);
    }


}
