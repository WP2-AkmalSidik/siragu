<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax() && $request->mode == 'select') {
            $data = User::where('role', 'admin')->get();
            return $this->successResponse(
                $data,
                'Data berhasil ditemukan',
            );
        } else if ($request->ajax()) {
            $perPages = 5;
            $query    = User::where('role', 'admin');

            if ($request->has('search') && $request->search != '') {
                $query->where('nama', 'like', '%' . $request->search . '%');
            }

            if ($request->filled('perPage') && $request->perPage != '') {
                $perPages = $request->perPage;
            }

            $penggunas = $query->orderBy('created_at')->paginate($perPages);

            $data = [
                'view'       => view('pages.admin.pengguna.table', compact('penggunas'))->render(),
                'pagination' => (string) $penggunas->links('vendor.pagination.tailwind'),
            ];

            return $this->successResponse($data, 'Data berhasil ditemukan.');
        }
        return view('pages.admin.pengguna.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'   => 'required',
            'email'  => 'required|email|unique:users,email',
            'no_hp'  => 'nullable|unique:users,no_hp',
            'status' => 'required|in:1,0',
        ]);

        try {
            User::create([
                'nama'     => $validated['nama'],
                'email'    => $validated['email'],
                'no_hp'    => $validated['no_hp'],
                'role'     => 'admin',
                'password' => bcrypt('password'),
                'status'   => $validated['status'],
            ]);

            return $this->successResponse(null, 'Guru berhasil ditambahkan.');
        } catch (\Exception $e) {
            return $this->errorResponse(null, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $data = User::find($id);
            return $this->successResponse($data, 'Data berhasil ditemukan.');
        } catch (\Exception $e) {
            return $this->errorResponse(null, $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama'   => 'required',
            'status' => 'required|in:1,0',
            'email'  => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
            'no_hp'  => ['nullable', Rule::unique('users', 'no_hp')->ignore($id)],
            'nip'    => ['nullable', Rule::unique('users', 'nip')->ignore($id)],
        ]);

        try {
            User::find($id)->update([
                'nama'   => $validated['nama'],
                'email'  => $validated['email'],
                'no_hp'  => $validated['no_hp'],
                'status' => $validated['status'],
            ]);

            return $this->successResponse(null, 'Guru berhasil diupdate.');
        } catch (\Exception $e) {
            return $this->errorResponse(null, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            User::find($id)->delete();
            return $this->successResponse(null, 'Guru berhasil dihapus.');
        } catch (\Exception $e) {
            return $this->errorResponse(null, $e->getMessage());
        }
    }

    public function profile()
    {
        return view('pages.admin.profil.index');
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
