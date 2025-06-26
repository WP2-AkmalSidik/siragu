<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\JsonResponder;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use JsonResponder;
    public function login(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('pages.auth.login');
        }

        $validated = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (! $user) {
            return $this->errorResponse(null, 'Akun dengan alamat email ' . $validated['email'] . ' tidak ditemukan.');
        }

        if (auth()->attempt($validated)) {
            return $this->successResponse(null, 'Login Berhasil. Anda akan di alikan ke dashboard.');
        } else {
            return $this->errorResponse(null, 'Password Salah.');
        }
    }

    public function logout()
    {
        try {
            auth()->logout();
            return $this->successResponse(null, 'Logout Berhasil.');
        } catch (\Exception $e) {
            return $this->errorResponse(null, 'Logout Gagal ' . $e->getMessage());
        }
    }
}
