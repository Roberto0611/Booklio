<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    # Functions for views
    public function index(){
        return view('logIn.logIn'); 
    }

    public function indexRegister(){
        return view('logIn.register');
    }

    # Functions for login
    public function register(Request $request){
        # Important here add data validation

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        Auth::login($user);

        return redirect(route('books.index'));
    }

    public function logOut(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();  

        return redirect(route('landing'));
    }

    public function login(Request $request){
        # Important here add data validation

        $credentials = [
            "email" => $request->email,
            "password" => $request->password
        ];

        $remember = ($request->has('remember') ? true : false);

        if(Auth::attempt($credentials,$remember)){
            $request->session()->regenerate();

            return redirect()->intended(route('books.index'));
        }else{
            return redirect('login');
        }
    }
}
