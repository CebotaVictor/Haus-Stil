<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showCart(){
        $carts = null;
        $products = null;
        if (auth()->check()) {
            $carts = Cart::where('user_id', auth()->id())->get();
            if(!$carts->isEmpty()){
                $products = Product::all();
            }
        } else {            
            $carts = session()->get('cart', []);
            if(!empty($carts)){
                $products = Product::all();
            }
        }
    
        return view("cart.cart", compact('carts', 'products'));
    }


   
    // public function index($id)
    // {
    //     $product = Product::find($id);
    //     $carts = Cart::all();
    //     return view("cart.cart",compact("product, carts"));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id)
    {
        $product = Product::find($id);

        if($product){
            if(auth()->check()){
                $cart = Cart::where('user_id' , auth()->id())
                ->where('product_id', $id)
                ->first();
                
                if($cart){
                    $cart->total_products++;           
                }
                else{
                    $cart = new Cart();
                    $cart->user_id = auth()->id();
                    $cart->product_id = $id;
                    $cart->total_products = 1;
                }
                $cart->save();
            }
            else{
                $cart = session()->get('cart',[]);

                if(isset($cart[$id])){
                    $cart[$id]['total_products'] ++;
                }
                else{
                    $cart[$id] = [
                        "product_id" => $product->id,
                        "total_products" => 1,
                    ];
                }

                session()->put('cart', $cart);
            }
        }

        return redirect()->route('cart')->with('success', 'Product added to cart.');
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
        $product = Product::find($id);
        if($product){
            if(auth()->check()){
                $carts = Cart::where('product_id', $id)
                ->where('user_id', auth()->id())
                ->first();  
                $carts->delete();
                return redirect()->route('cart')->with('success', 'Deleting product with success');
            }
            else{
                $carts = session()->get('cart');

                if (isset($carts[$id])) {
                    unset($carts[$id]);
                    session()->put('cart', $carts);
                    return redirect()->route('cart')->with('success', 'Deleting product with success');
                }
                else return redirect()->route('cart')->with('error', 'Deleting product with no success');
            }
        }

        else return redirect()->route('cart')->with('error', 'Deleting product with no success');
    }
}
