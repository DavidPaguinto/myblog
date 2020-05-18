<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class PageController extends Controller
{
    public function index(){
    	return redirect('/blogs');
    }    

    public function about(){
    	return view('pages.about');
    }
}
