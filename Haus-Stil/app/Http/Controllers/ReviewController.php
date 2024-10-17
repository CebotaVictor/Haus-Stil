<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::all();
        return route('prod.details', 'reviews');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        try {
            $request->validate( [
                'message' => ['required', 'string', 'min:1' , 'max:255'],    
            ]);
            
            if(auth()->check()){
                $product = Product::find($id);
                if($product){
                    $review = Review::create([
                        'message'=> $request['message'],
                        'user_id' => auth()->id(),
                        'product_id' => $id,
                    ]);
                    return redirect()->route('prod.details', compact('id'))->with('success','');
                }
                else return redirect()->route('home.shop')->with('error',''); 
            }
            else{
                return redirect()->route('login')->with('error','');
            }
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $review = Review::find($id);
        $product = Product::find($review->product_id);
        $prod_id = $product->id; 
        
        if($review){
            $review->delete();

            return redirect()->route('prod.details', $prod_id)->with('success','');
        }

        return redirect()->route('home.shop')->with('error','');
        
    }
}
