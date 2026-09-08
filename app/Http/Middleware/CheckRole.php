<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * Usage in routes: ->middleware('role:admin')
     * Multiple roles allowed: ->middleware('role:admin,staff')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        // Agar user login hi nahi hai (safety check, 'auth' middleware pehle chalna chahiye)
        if (!$user) {
            return redirect()->route('login');
        }

        $userRole = strtolower($user->role);
        $allowedRoles = array_map('strtolower', $roles);

        if (!in_array($userRole, $allowedRoles)) {
            abort(403, 'You are not authorized to access this page.👀');
        }

        return $next($request);
    }
}
