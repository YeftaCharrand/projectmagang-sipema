<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DosenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user->role == 'dosen') {

            //mengakses dosen melalui relasi
            $dosen = $user->dosen;

            // Menambahkan atribut untuk menunjukkan apakah dosen adalah dosen wali
            if ($dosen && $dosen->kelas_id) {
                $request->attributes->set('is_dosen_wali', true);
            } else {
                $request->attributes->set('is_dosen_wali', false);
            }
            return $next($request);
        }
        return redirect()->back();
    }
}
