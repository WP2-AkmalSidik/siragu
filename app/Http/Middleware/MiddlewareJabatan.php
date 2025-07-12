<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MiddlewareJabatan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$jabatans): Response
    {
        $user = auth()->user();

        if (! $user) {
            abort(403, 'Tidak terautentikasi.');
        }

        $userJabatans = $user->jabatans->pluck('jabatan.jabatan')->toArray();

        // Cek apakah salah satu jabatan yang dimiliki user cocok dengan yang diminta
        if (! array_intersect($jabatans, $userJabatans)) {
            abort(403, 'Akses ditolak. Jabatan tidak sesuai.');
            return redirect()->back();
        }

        return $next($request);
    }
}
