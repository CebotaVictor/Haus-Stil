<?php

namespace App\Http\Controllers;

use App\Enums\UType;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfile(){
        if (Auth::check()) {
            $user = Auth::user();
            $feedbacks = Feedback::all();
            return view('profile.profile', compact('user', 'feedbacks'));
        } else {
            return redirect()->route('login'); 
        }
    }

    public function updateProfile(Request $request){
        try {
        $request->validate( [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

        if (Auth::check()) {
            $user = Auth::user();
            if($user){

            $imageModel = new Image();
            $imageName = $imageModel->StoreUserImage($request, $user->id);
            $user->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'username' => $request->username,
                'email' => $request->email,
                'imageName' => $imageName,
            ]);     
            return redirect()->route('profile', compact('user'));
            }
            else{
                return redirect()->route('home.home');
            }
        }
         else {
            return redirect()->route('login'); // Redirect if not authenticated
        }
    } catch (ValidationException $e) {
        // If validation fails, catch the error and inspect
        dd($e->errors());  // Dump validation errors for inspection
    }

       
        
    }

}   
