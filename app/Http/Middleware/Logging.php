<?php

namespace App\Http\Middleware;

use App\Models\Log;
use Closure;
use Illuminate\Http\Request;

class Logging
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $keterangan)
    {
        $response = $next($request);

        if (auth("guard_mahasiswa")->check()) {
            Log::create([
                "user_id" => auth("guard_mahasiswa")->user()->id,
                "role" => "mahasiswa",
                "keterangan" => $keterangan,
                "route_path" => $request->fullUrl(),
                "ip_address" => $request->ip(),
                "status_code" => $response->status(),
            ]);
        } else if (auth("guard_dosen")->check()) {
            Log::create([
                "user_id" => auth("guard_dosen")->user()->id,
                "role" => "dosen",
                "keterangan" => $keterangan,
                "route_path" => $request->fullUrl(),
                "ip_address" => $request->ip(),
                "status_code" => $request->status(),
            ]);
        }

        return $response;
    }
}
