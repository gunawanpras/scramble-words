<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct() {
        
    }

    public function index() {
        return view('public/index');
    }

    public function home(Request $request) {        
        return view('home');
    }    
}
