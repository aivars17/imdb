<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function index()
    {
        return view('category.form');
    }
    public function category_save(Request $request)
    {
        $user = Auth::user();
        $user->categories()->create($request->except('_token'));
        session()->flash('status','Save successful!!!');
        return redirect()->back();
    }
    public function category_delete($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();
        return redirect()->back();
    }
}
