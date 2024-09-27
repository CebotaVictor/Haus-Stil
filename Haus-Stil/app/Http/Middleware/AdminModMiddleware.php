<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Enums\UType;

class AdminModMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
{
    // Split the roles string by commas into an array
    $rolesArray = explode(',', $roles);

    $user = Auth::user(); // Get the authenticated user

    if ($user && $this->hasRole($user, $rolesArray)) {
        return $next($request); // Proceed if the user has the required role
    }

    // If the user does not have the required role, redirect or abort
    return redirect()->route('home.home');
}

private function hasRole($user, array $roles): bool
{
    foreach ($roles as $role) {
        if ((int) $user->user_type->value === (int) $role) { // Ensure both are compared as integers
            return true;
        }
    }
    return false;
}

}
