<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Package;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function welcomePage(){
        $packages = Package::latest('id')->with('photos')->paginate(3);
        return view('welcome',compact('packages'));
    }
    public function profile(){
        $bookings = Booking::where('user_id',Auth::id())->with('package')->latest('id')->paginate(10);
        return view('profile.index',compact('bookings'));
    }
}
