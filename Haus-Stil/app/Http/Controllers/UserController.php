<?php

namespace App\Http\Controllers;
use App\Enums\UType;
use App\Models\Image;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function __construct()
     {
        $this->middleware('admin.mod:' . UType::Admin->value);
     }

     
     public function create()
    {
        $userTypes = UType::cases();
        return view('user.create', compact('userTypes'));
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
            'user_type' => ['nullable', Rule::in(array_column(UType::cases(), 'value'))],
        ]);
        
        $user = User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'user_type' => $request['user_type'],
            // 'imageName' => $imageName,
        ]);
        $image = new Image();
        $imageName = $image->StoreUserImage($request, $user->id);

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
            'user_type' => ['required', Rule::in(array_column(UType::cases(), 'value'))],
        ]);

        $user = User::find($id);

        $imageModel = new Image();
        if($imageModel){
            $imageName = $imageModel->StoreUserImage($request, $id);
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request['password']),
                'imageName' => $imageName,
                'user_type' => $request['user_type'],
            ]);     
            return redirect()->route('user.read')->with('success', 'Post updated successfully.');
        }
        else{
            return redirect()->route('home.home')->with('error','Post updated unsuccessfully.');
        }
        
    }

    public function edit(string $id){
        $user = User::findOrFail($id);
        $userTypes = UType::cases();
        return view('user.edit', compact('user', 'userTypes'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $image = new Image();
        $image->DeleteUserFolder($user->id);
        $user->delete();

        return redirect()->route('user.read')
            ->with('success', 'user deleted successfully');
    }
}
