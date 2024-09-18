<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function create()
    {
        return view('user.create');
    }


    public function index()
    {
        $users = User::all();

        return view('user.read', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
        $request->validate( [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:4'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);
        
        $user = User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => $request['password'],
            // 'imageName' => $imageName,
        ]);
        $image = new Image();
        $imageName = $image->StoreImage($request, $user->id);

        $user->update([
            'imageName' => $imageName,
        ]);

        return redirect()->route('user.read')->with('success', 'user created successfully.');
    } catch (ValidationException $e) {
        // If validation fails, catch the error and inspect
        dd($e->errors());  // Dump validation errors for inspection
    }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate( [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:8'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

        $user = User::find($id);

        $imageModel = new Image();
        if($imageModel){
            $imageName = $imageModel->StoreImage($request, $id);
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password'=> $request->password,
                'imageName' => $imageName,
            ]);     
            return redirect()->route('user.read')->with('success', 'Post updated successfully.');
        }
        else{
            return redirect()->route('home.home')->with('error','Post updated unsuccessfully.');
        }
        
    }

    public function edit(string $id){
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $image = new Image();
        $image->DeleteFile($user->id);
        $user->delete();

        return redirect()->route('user.read')
            ->with('success', 'user deleted successfully');
    }
}
