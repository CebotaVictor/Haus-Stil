<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        return view('categories.create');
    }


    public function index()
    {
        $categories = Category::all();

        return view('categories.read', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
        $request->validate( [
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);
        
        $categories = Category::create([
            'name' => $request['name'],
        ]);
        $image = new Image();
        $imageName = $image->StoreCatImage($request, $categories->id);

        $categories->update([
            'imageName' => $imageName,
        ]);

        return redirect()->route('cat.read',compact('categories'))->with('success', 'user created successfully.');
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
        try{ 
        $request->validate( [
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

        $category = Category::find($id);

        $imageModel = new Image();
        if($imageModel){
            $imageName = $imageModel->StoreCatImage($request, $id);
            $category->update([
                'name' => $request->name,
                'imageName' => $imageName,
            ]);     
            return redirect()->route('cat.read')->with('success', 'Post updated successfully.');
        }
        else{
            return redirect()->route('home.home')->with('error','Post updated unsuccessfully.');
        }
        }catch (ValidationException $e) {
            // If validation fails, catch the error and inspect
            dd($e->errors());  // Dump validation errors for inspection
        }
        
    }

    public function edit(string $id){
        $categories = Category::findOrFail($id);
        return view('categories.edit', compact('categories'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $image = new Image();
        $image->DeleteCatFolder($category->id);
        $category->delete();

        return redirect()->route('cat.read')
            ->with('success', 'user deleted successfully');
    }
}
