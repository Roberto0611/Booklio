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

        # DATA VALIDATION
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed', 
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = 'Hola booklio, soy un nuevo usuario :)';
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
            return back()->withErrors(['email' => 'Las credenciales no coinciden.',])->onlyInput('email');
        }
    }
}
