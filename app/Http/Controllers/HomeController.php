<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Post;

class HomeController extends Controller
{
    public function index() 
    {
        //return view('home.index');
        // $posts = Post::with('getPostCategory')->get();
        // dd($users);
        return view('home.index');
    }
}
