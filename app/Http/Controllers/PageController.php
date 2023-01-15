<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Photo;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;

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
    public function setting(){
        return view('profile.setting');
    }
    public function settingUpdate(UpdateUserRequest $request){
        $user = User::find(Auth::id());
        if(!Hash::check($request->password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }
        if($request->has('name')){
            $user->name = $request->name; 
        }
        if($request->has('email')){
            $user->email = $request->email; 
        }
        if($request->has('new_password')){
            $user->password = Hash::make($request->new_password); 
        }
        $user->update();
        return back()->with('message','Account is updated successfully.');
    }
}
