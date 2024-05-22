<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class HomeController extends Controller
{
    function dashboard(){
        $quizes = Quiz::where('created_at','<=', Carbon::today())->latest()->paginate(10);
        
        return view('dashboard.dashboard',[
            'quizes' => $quizes,
        ]);
    }

    function register(){
        return view('user.register');
    }
    
    function store_registration(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ]);

        if($request->password != $request->confirm_password){
            return back()->with('wrong_pass', 'Password and Confirm password does not match!');
        }
        else{
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'created_at' => Carbon::now(),
            ]);
            return back()->with('success', "Congratulations! You've registered successfully");
        }

    }

    function login(){
        return view('user.login');
    }

    function attempt_login(Request $request){
        $request->validate([
            'email' => 'required|exists:users',
            'password' => 'required',
        ]);

        if(User::where('email', $request->email)->exists()){
            if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
                return redirect()->route('dashboard')->with('logged', "You're logged in!!");
            }
            else{
                return back()->with('wrong', 'Wrong credential.');
            }
        }
        else{
            return back()->with('exists', 'Email does not exists.');
        }
    }

    function logout(){
        Auth::logout();
        return redirect()->route('login')->with('logout', "You're logging out");
    }
}
