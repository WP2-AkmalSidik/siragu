<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MiddlewareRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = auth()->user();

        if (! $user) {
            abort(403, 'Tidak terautentikasi.');

        }

        // Cek apakah role user termasuk dalam daftar roles yang diizinkan
        if (! in_array($user->role, $roles)) {
            abort(403, 'Akses ditolak. Role tidak sesuai.');
            return redirect()->url('/' . $user->role);
        }

        return $next($request);
    }
}
