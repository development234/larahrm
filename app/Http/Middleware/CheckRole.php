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
     * Example usage:
     * ->middleware('role:admin')
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Pastikan user sudah login
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Cek role user
        if ($request->user()->role !== $role) {
            return response()->json(['message' => 'Forbidden: Access Denied'], 403);
        }

        return $next($request);
    }
}
