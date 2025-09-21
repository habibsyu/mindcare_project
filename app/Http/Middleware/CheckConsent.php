<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckConsent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()->consent_given) {
            return redirect()->route('consent.form')
                ->with('error', 'Anda perlu memberikan persetujuan sebelum menggunakan layanan ini.');
        }

        return $next($request);
    }
}