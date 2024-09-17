<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\User;

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
        $request->validate( [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'max:8'],
            'image' => ['required', 'image','mimes:jpeg,png,jpg,gif,svg'],
            'image_name' => ['required', 'string','max:255'],
        ]);

        
        $image = new Image();
        $imageName = $image->StoreImage($request, $request->id);

        User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => $request['password'],
            'imageName' => $imageName,
        ]);

        return redirect()->route('user.read')
        ->with('success', 'user created successfully.');
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
        ]);

        $user = User::find($id);

        $user->update($request->all());

        return redirect()->route('user.read')
            ->with('success', 'Post updated successfully.');
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
        $user->delete();

        return redirect()->route('user.read')
            ->with('success', 'user deleted successfully');
    }
}
