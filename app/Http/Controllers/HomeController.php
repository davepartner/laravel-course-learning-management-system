<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // 
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { $this->middleware('auth');
        return view('home');
    }

    public function welcome(){

        if(Auth::check()){
            return redirect()->route('courses.index');
        }
        $categories = Category::all();
        $courses = Course::all(); 

        return view('welcome')->with('courses',$courses)->with('categories', $categories);
    }
}
