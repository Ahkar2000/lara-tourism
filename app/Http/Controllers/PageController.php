<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Photo;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function welcomePage(){
        $packages = Package::latest('id')->with('photos')->paginate(3);
        return view('welcome',compact('packages'));
    }
}
