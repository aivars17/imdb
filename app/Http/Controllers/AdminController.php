<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;
use App\User;
use App\Movie;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.dashboard');
    }
    public function categories()
    {
        $categories = Categories::orderBy('name')->get();
        return view('admin.categories', [
            'title' => 'Categories',
            'cats' => $categories,
        ]);
    }
    public function show(Request $request)
    {

        $data = Categories::where('name', $request->get('category'))->first();
        $categories = Categories::get();
        return view('admin.categories', [
            'data' => $data,
            'cats' => $categories
            ]);
    }
    public function update_cat($id, Request $request)
    {
        Categories::findOrFail($id)->update($request->except('_token'));
        return redirect()->back();
    }
    public function users()
    {
        $users = User::get();
        return view('admin.users', [
            'title' => 'Users',
            'users' => $users
        ]);
    }
    public function admin_role($id, Request $request)
    {

      $user = User::findOrFail($id);
        $user->update($request->except('_token') + [
                'role' => $request->user_role
            ]);
        session()->flash('status', $user->name . ' role was changed');
        return redirect()->back();
    }
    public function user_delete($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('status', 'User was deleted');
        return redirect()->back();
    }

}
