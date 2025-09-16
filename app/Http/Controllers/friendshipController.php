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

        // Evitar seguirse a sí mismo
        if ($user->id === $friend->id) {
            return redirect()->back()->with('success', 'No puedes seguirte a ti mismo.');
        }

        // Idempotencia: si ya existe, no crear duplicados
        $follow = Friendship::firstOrCreate(
            [
                'user_id' => $user->id,
                'friend_id' => $friend->id,
            ],
            [
                'status' => 'accepted',
            ]
        );

        if ($follow->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Ahora sigues a ' . $friend->name);
        }

        return redirect()->back()->with('success', 'Ya sigues a ' . $friend->name);
    }

    public function unfollow($id){
        $user = Auth::user();
        $friend = User::findOrFail($id);

        $follow = Friendship::where('user_id', $user->id)
                ->where('friend_id', $friend->id)
                ->where('status', 'accepted')
                ->first();

        if (!$follow) {
            return redirect()->back()->with('success', 'Ya no seguías a ' . $friend->name);
        }

        $follow->delete();

        return redirect()->back()->with('success', 'Dejaste de seguir a ' . $friend->name);
    }

    public function list($id,$tab){
        $user = User::findOrFail($id);
        if ($tab == 'following') {
            $list = Friendship::where('user_id', $user->id)
                    ->where('status', 'accepted')
                    ->with('friend')
                    ->get()
                    ->map(function($friendship) {
                        return $friendship->friend;
                    });
            return view('friends.list', compact('list', 'user', 'tab'));
        } else if ($tab == 'followers') {
            $list = Friendship::where('friend_id', $user->id)
                    ->where('status', 'accepted')
                    ->with('user')
                    ->get()
                    ->map(function($friendship) {
                        return $friendship->user;
                    });
            return view('friends.list', compact('list', 'user', 'tab'));
        }
    }
}
