<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Memeriksa apakah pengguna yang sedang masuk memiliki peran admin (id 2)
        if (Auth::user()->id == 2) {
            // Jika iya, lanjutkan ke halaman yang diminta
            return $next($request);
        }else{
        // Jika bukan admin, arahkan pengguna ke halaman yang sesuai (misalnya, halaman LOGIN)
        return redirect('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
    }
}
