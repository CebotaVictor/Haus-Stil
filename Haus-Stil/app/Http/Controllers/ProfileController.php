<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfile(){
        if (Auth::check()) {
            $user = Auth::user();
            return view('profile.profile', compact('user'));
        } else {
            return redirect()->route('login'); // Redirect if not authenticated
        }
    }

    public function updateProfile(Request $request,int $id){
        
        $request->validate( [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'image' => ['required', 'image','mimes:jpeg,png,jpg,gif,svg'],
        ]);

        $user = User::find($id);

        if($user == null){
            return redirect()->route('home.home');
        }
        else{
            return redirect()->route('home.home');
        }

        // $imageModel = new Image();
        // $imageName = $imageModel->StoreImage($request, $user->id);
        // $user->update([
        //     'name' => $request->name,
        //     'username' => $request->username,
        //     'email' => $request->email,
        //     'imageName' => $imageName,
        // ]);
        // return redirect()->route('showProfile');
    }

}   
