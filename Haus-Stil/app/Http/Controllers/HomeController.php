<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class HomeController extends Controller
{
    public function home(){
        return view("home.home");
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
        return view("home.shop");
    }

    public function confirmed(){
        return view("home.confirmed");
    }

    // public function about(){

    // }
}
