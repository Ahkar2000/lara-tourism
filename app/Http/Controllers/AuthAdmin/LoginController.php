<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{
    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;
    
    public function __construct() {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    /**
     * 
     * @return type
     */
    public function showLoginForm() {
        return view('authadmin.login');
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function login(Request $request) {
        // Validate the form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        
        // Attempt to log the user in
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->route('admin.dashboard');
        }
        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'))
                ->withErrors(['password' => [
                    'These credentials don\'t match our records.', 
                    'Or Incorrect Password'
                ]]);
    }

    /**
     * 
     * @return type
     */
    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}