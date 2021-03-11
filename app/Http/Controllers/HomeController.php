<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      // blog with count
      $blog = Blog::withCount('comments');
      // comment 
      dd($blog->toSql(), $blog->get(2));
      dd($blog->take(2)->toSql());
      return $blog;
        return view('home');
    }
}
