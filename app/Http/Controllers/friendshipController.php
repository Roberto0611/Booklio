<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class friendshipController extends Controller
{
    public function index(){
        $recommendations = User::all();

        return view('friends.index',compact('recommendations'));
    }
}
