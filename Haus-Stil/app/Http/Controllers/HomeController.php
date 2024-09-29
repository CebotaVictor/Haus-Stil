<?php

namespace App\Http\Controllers;

use App\Enums\UType;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Checkout;
use App\Models\Feedback;
use Illuminate\Validation\ValidationException;
use App\Models\Product;
use App\Models\User;
use App\Mail\CheckoutMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Auth;
use Illuminate\Http\Request;



class HomeController extends Controller
{
    public function home(){
        $categories = Category::all();

        return view("home.home",compact("categories"));
    }

    public function about(){
        return view("home.about");
    }

    public function blog(){
        return view("home.blog");
    }
    
    public function showCheckout(){
        return view("home.checkout");
    }

    public function checkout(Request $request){
        if(auth()->user()){
            $products = json_decode($request->input('products'), true);
            if($products){
                $first_elem = $products[0];
                return view('home.checkout', compact('products'));
            }
            else return redirect()->route("login"); 
        }
        else{
            return redirect()->route("login");
        }
    }

    public function storeCheckout(Request $request){
        try {
            $validatedData = $request->validate( [
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'country' => ['required', 'string', 'max:255'],
                'address' => ['required', 'string', 'max:255'],
                'postal_number' => ['required', 'numeric', 'min:0'],
                'city' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'card_number' => ['required', 'string', 'max:255'],
                'expire_date' => ['required', 'string', 'max:255'],
                'ccv' => ['required', 'string', 'max:255'],
                'total_price' => ['required','string', 'max:255'],
            ]);
            
            $check = Checkout::create([
                'firstname' => $request['firstname'],
                'lastname' => $request['lastname'],
                'country' => $request['country'],
                'address' => $request['address'],
                'postal_number' => $request['postal_number'],
                'city' => $request['city'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'card_number' => $request['card_number'],
                'card_name' => $request['card_name'],
                'expire_date' => $request['expire_date'],
                'ccv' => $request['ccv'],
                'total_price' => $request['total_price'],
            ]);

            if($check){
                Mail::to($validatedData['email'])->send(new CheckoutMail($validatedData));
                return redirect()->route('home.home')->with('success','');
            }                        
            return redirect()->route('home.store')->with('error', '');
        } catch (ValidationException $e) {
            // If validation fails, catch the error and inspect
            dd($e->errors());  // Dump validation errors for inspection
        }
        }
    


    public function showFeedback(){
        return view("home.feedback");
    }

    public function sendFeedback(Request $request){
        if(auth()->user()){
            try {
                $request->validate( [
                    'firstname' => ['required', 'string', 'max:255'],
                    'lastname' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255'],
                    'message' => ['required', 'string', 'max:350'],
                    'user_type' => ['nullable', Rule::in(array_column(UType::cases(), 'value'))],
                ]);
                
                $user = auth()->user();


                $feedback = Feedback::create([
                    'firstname' => $request['firstname'],
                    'lastname' => $request['lastname'],
                    'email' => $request['email'],
                    'message' => $request['message'],
                    'user_id' => $user->id,
                    'user_type' => $request['user_type'],
                ]);
                
                return redirect()->route('user.read')->with('success', 'user created successfully.');
            } catch (ValidationException $e) {
                // If validation fails, catch the error and inspect
                dd($e->errors());  // Dump validation errors for inspection
            }
        }
        else{
            return redirect()->route('home.home')->with('error','');
        }
    }

    public function services(){
        return view("home.services");
    }

    public function shop(){
        $user = null;
        if(auth()->check()){
            $user = User::find(auth()->user()->id);
            $categories = Category::all();
            $products = Product::all();
            return view("home.shop", compact("categories", "products", "user"));
        }
        $categories = Category::all();
        $products = Product::all();
        return view("home.shop", compact("categories", "products", "user"));

    }

    public function confirmed(){
        return view("home.confirmed");
    }

    
    // public function about(){

    // }
}
