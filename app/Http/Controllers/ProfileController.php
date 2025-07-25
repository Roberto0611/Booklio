<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function details(){
        return view('profile.details');
    }

    public function edit(){
        return view('profile.edit');
    }

    
    public function update(Request $request){

        $user = Auth::user();

        # DATA VALIDATION
        $request->validate([
            'username' => 'required|string|max:255|unique:users,name,'.$user->id,
            'bio' => 'nullable|string|max:255',
        ]);

        if($request->hasFile('profile_picture')){
            $image = $request->profile_picture;
            $imageName = rand().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads'),$imageName);
            $path = "/uploads/".$imageName;
            $user->photo = $path;
        }

        $user->name = $request->username;
        $user->bio = $request->bio;

        $user->save();
        
        return redirect(route('profile'));
    }
}
