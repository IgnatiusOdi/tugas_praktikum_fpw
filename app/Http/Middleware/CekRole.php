<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if ($role == "dosen") {
            if (auth("guard_dosen")->check()) {
                return $next($request);
            }
        } else {
            if (auth("guard_mahasiswa")->check()) {
                return $next($request);
            }
        }

        abort(403);
    }
}
