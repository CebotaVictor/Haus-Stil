<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProductInCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $prodId = $request->route('product')->id;
        $user_id = auth()->user()->id;

        $cart = Cart::where('user_id', $user_id)->where('product_id', $prodId)->first();
        
        if(!$cart) {
            return redirect()->route('login')->with('error','');
        }
        return $next($request);
    }
}
