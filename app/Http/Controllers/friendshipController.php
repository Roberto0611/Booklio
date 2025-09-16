<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class friendshipController extends Controller
{
    public function index(){
        $recommendations = User::inRandomOrder()->limit(12)->get();

        return view('friends.index',compact('recommendations'));
    }

    public function follow($id){
        $user = Auth::user();
        $friend = User::findOrFail($id);

        $follow = new Friendship();
        $follow->user_id = $user->id;
        $follow->friend_id = $friend->id;
        $follow->status = 'accepted';
        $follow->save();

        return redirect()->back()->with('success', 'Ahora sigues a ' . $friend->name);
    }

    public function unfollow($id){
        $user = Auth::user();
        $friend = User::findOrFail($id);

        $follow = Friendship::where('user_id', $user->id)
                ->where('friend_id', $friend->id)
                ->where('status', 'accepted')
                ->first();
        
        $follow->delete();
        
        return redirect()->back()->with('success', 'Dejaste de seguir a ' . $friend->name);
    }
}
