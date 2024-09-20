<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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

    public function cart(){
        return view("home.cart");
    }
    

    public function checkout(){
        return view("home.checkout");
    }

    public function contact(){
        return view("home.contact");
    }

    public function services(){
        return view("home.services");
    }

    public function shop(){
        $categories = Category::all();
        $products = Product::all();
        return view("home.shop", compact("categories", "products"));
    }

    public function confirmed(){
        return view("home.confirmed");
    }

    // public function about(){

    // }
}
