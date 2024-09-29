<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class aboutController extends Controller
{
    public function aboutPage(){
        return view('about');
    }

    public function contactPage(){
        return view('contact');
    }
    
}
