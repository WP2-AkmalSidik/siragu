<?php
namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('pages.guru.profil.index');
    }

    public function updateProfile(Request $request)
    {
        $id        = auth()->user()->id;
        $validated = $request->validate([
            'nama'  => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
            'no_hp' => ['nullable', Rule::unique('users', 'no_hp')->ignore($id)],
            'nip'   => ['nullable', Rule::unique('users', 'nip')->ignore($id)],
        ]);

        DB::beginTransaction();

        try {
            User::find($id)->update([
                'nama'  => $validated['nama'],
                'email' => $validated['email'],
                'no_hp' => $validated['no_hp'],
                'nip'   => $validated['nip'],
            ]);

            DB::commit();

            return $this->successResponse(null, 'Profil berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse(null, $e->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        // dd($request->all());
        $id        = auth()->user()->id;
        $validated = $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $user = User::find($id);
            if (! Hash::check($validated['password_lama'], $user->password)) {
                return $this->errorResponse(null, 'Password lama tidak sesuai.');
            }

            $user->update([
                'password' => bcrypt($validated['password_baru']),
            ]);

            DB::commit();

            return $this->successResponse(null, 'Password berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->errorResponse(null, $e->getMessage());
        }
    }

    public function updateTtd(Request $request)
    {
        $validated = $request->validate([
            'ttd' => 'required',
        ]);

        try {
            $dataURL = $validated['ttd'];

            // Pisahkan prefix data URL dan base64
            if (preg_match('/^data:image\/(\w+);base64,/', $dataURL, $type)) {
                $data = substr($dataURL, strpos($dataURL, ',') + 1);
                $type = strtolower($type[1]); // png, jpg, etc.

                if (! in_array($type, ['png', 'jpg', 'jpeg'])) {
                    return $this->errorResponse(null, 'Format gambar tidak didukung.');
                }

                $data = base64_decode($data);

                if ($data === false) {
                    return $this->errorResponse(null, 'Gagal decoding tanda tangan.');
                }
            } else {
                return $this->errorResponse(null, 'Data tanda tangan tidak valid.');
            }

            // Simpan ke storage
            $fileName = 'ttd_' . auth()->id() . '_' . time() . '.' . $type;

// Simpan dengan disk 'public'
            Storage::disk('public')->put('ttd/' . $fileName, $data);

// Simpan path tanpa "public/"
            User::find(auth()->id())->update([
                'ttd' => 'ttd/' . $fileName,
            ]);

            return $this->successResponse(null, 'Tanda tangan berhasil diupdate.');
        } catch (\Exception $e) {
            return $this->errorResponse(null, $e->getMessage());
        }
    }
}
