<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    public function profile(){
        if (Auth::check()) {
            $user = Auth::user();
            return view('profile.profile', compact('user'));
        } else {
            return redirect()->route('login'); // Redirect if not authenticated
        }
    }
}   
