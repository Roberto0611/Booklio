<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Friendship;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function details($id){
        $user = User::findOrFail($id);
        $currentUser = Auth::user();
        
        # check if the user follows this profile
        $isFollowing = Friendship::where('user_id', $currentUser->id)
                ->where('friend_id', $user->id)
                ->where('status', 'accepted')
                ->exists();

        $followers = Friendship::where('friend_id', $user->id)
                ->where('status', 'accepted')
                ->count();
        
        $following = Friendship::where('user_id', $user->id)
                ->where('status', 'accepted')
                ->count();

        $lastReadBooks = $user->books()->wherePivot('is_readed', 1)->latest()->take(5)->orderByDesc('read_at')->get();
        $favoriteBooks = $user->books()->wherePivot('is_favorite', 1)->get();
        return view('profile.details', compact('id','lastReadBooks','favoriteBooks','user','isFollowing','followers','following'));
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

    public function recentBooks($id){
        $user = User::findOrFail($id);
        $recentBooks = $user->books()->wherePivot('is_readed', 1)->latest()->orderByDesc('read_at')->get();
        return view('profile.recentBooks', data: compact('recentBooks', 'id', 'user'));
    }
}
