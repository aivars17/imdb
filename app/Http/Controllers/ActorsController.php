<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Auth;
use App\Actor;
use App\Movie;
use Illuminate\Support\Facades\Storage;




class ActorsController extends Controller
{
    public function index()
    {

    }
    public function actors()
    {
        $movies = Movie::all();
        $actors = Actor::all();
        return view('admin.actors', ['actors' => $actors, 'movies' => $movies]);
    }
    public function actor_save(Request $request)
    {

        $user = Auth::user();
        $actor = $user->actor()->create($request->except('_token'));

        $actor->movie()->attach($request->states);
        return redirect()->back()->with('status', 'saved');
    }
    public function actor_update($id, Request $request)
    {
        $actor = Actor::findOrFail($id);
        $actor->update($request->except('_token'));
        $actor->movie()->sync($request->states);

        return redirect()->back()->with('status', 'updated');
    }
    public function actor_edit($id)
    {
        $movies = Movie::all();
        $actors = Actor::all();
        $actor = Actor::findOrFail($id);
        $actor_movie = $actor->movie;
        return view('admin.actors', [
           'actors' => $actors,
           'movies' => $movies,
           'actor' => $actor,
           'actor_movie' => $actor_movie,
        ]);
    }
    public function actor_delete($id)
    {
        $actor = Actor::findOrFail($id);
        $images = $actor->image;
        foreach ($images as $image){
            Storage::delete('public/image/'.$image->filename);
        }
        $actor->movie()->detach();
        $actor->image()->delete();
        session()->flash('status', 'Actor '.$actor->name.' delete successful');
        $actor->delete();

        return redirect()->back();
    }
}
