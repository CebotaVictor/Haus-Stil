<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }


    public function index()
    {
        $products = Product::all();

        return view('products.read', compact('products'));
    }

    public function details(string $id){
        $product = Product::find($id);

        return view('products.product', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    try {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:50'],
            'price' => ['required', 'numeric', 'min:0'],  // Change to numeric for better validation of price
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'category_id' => 'required|exists:categories,id',
        ]);

        // Fetch the category ID and name
        $id = $request->category_id;
        $name = Category::find($id)->name;

        // Create a new product with all necessary fields, including category_id
        $products = Product::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price'],
            'category_id' => $request['category_id'],  // Include category_id
            'categoryName' => $name, // Store category name as well
        ]);

        // Handle image upload if provided
        $image = new Image();
        $imageName = $image->StoreProdImage($request, $products->id);

        // Update product with the image name if uploaded
        $products->update([
            'imageName' => $imageName,
        ]);

        return redirect()->route('prod.read', compact('products'))->with('success', 'Product created successfully.');
    } catch (ValidationException $e) {
        // Dump validation errors for debugging
        dd($e->errors());
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
            'description' => ['nullable', 'string', 'max:50'],
            'price' => ['required', 'numeric', 'min:0'],  // Change to numeric for better validation of price
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp'],
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::find($id);
        $id = $request->category_id;
        $name = Category::find($id)->name;

        $imageModel = new Image();
        if($imageModel){
            $imageName = $imageModel->StoreProdImage($request, $product->id);
            $product->update([
                'name' => $request['name'],
                'description' => $request['description'],
                'price' => $request['price'],
                'categoryName' => $name,
                'category_id' => $request['category_id'],   
                'imageName' => $imageName,
            ]);     
            return redirect()->route('prod.read')->with('success', 'product updated successfully.');
        }
        else{
            return redirect()->route('home.home')->with('error','product updated unsuccessfully.');
        }
        }catch (ValidationException $e) {
            // If validation fails, catch the error and inspect
            dd($e->errors());  // Dump validation errors for inspection
        }
        
    }

    public function edit(string $id){
        $products = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('products', 'categories'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $image = new Image();
        $image->DeleteProdFolder($product->id);
        $product->delete();

        return redirect()->route('prod.read')
            ->with('success', 'product deleted successfully');
    }
}
