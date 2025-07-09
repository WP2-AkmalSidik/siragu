<?php
namespace App\Http\Controllers;

use App\Models\JabatanUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax() && $request->mode == 'select') {
            $data = User::with('jabatans.jabatan')->where('role', 'guru')->get();
            return $this->successResponse(
                $data,
                'Data berhasil ditemukan',
            );
        } else if ($request->ajax()) {
            $perPages = 5;
            $query    = User::with('jabatans.jabatan')->where('role', 'guru');

            if ($request->has('search') && $request->search != '') {
                $query->where('nama', 'like', '%' . $request->search . '%');
            }

            if ($request->filled('perPage') && $request->perPage != '') {
                $perPages = $request->perPage;
            }

            $gurus = $query->orderBy('created_at')->paginate($perPages);

            $data = [
                'view'       => view('pages.admin.guru.table', compact('gurus'))->render(),
                'pagination' => (string) $gurus->links('vendor.pagination.tailwind'),
            ];

            return $this->successResponse($data, 'Data berhasil ditemukan.');
        }
        return view('pages.admin.guru.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip'          => 'nullable|unique:users,nip',
            'nama'         => 'required',
            'email'        => 'required|email|unique:users,email',
            'no_hp'        => 'nullable|unique:users,no_hp',
            'status'       => 'required|in:1,0',
            'jabatan_id'   => 'nullable|array|min:1',
            'jabatan_id.*' => 'nullable',
        ]);

        DB::beginTransaction();

        try {
            $user = User::create([
                'nip'      => $validated['nip'],
                'nama'     => $validated['nama'],
                'email'    => $validated['email'],
                'no_hp'    => $validated['no_hp'],
                'role'     => 'guru',
                'password' => bcrypt('password'),
                'status'   => $validated['status'],
            ]);

            // Handle jabatan jika ada
            if (isset($validated['jabatan_id'])) {
                foreach ($validated['jabatan_id'] as $jabatan_id) {
                    JabatanUser::firstOrCreate([
                        'jabatan_id' => $jabatan_id,
                        'user_id'    => $user->id,
                    ]);
                }
            }

            DB::commit();

            return $this->successResponse($user, 'Guru berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse(null, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = User::with('jabatans.jabatan')->findOrFail($id);
            return $this->successResponse($data, 'Data berhasil ditemukan.');
        } catch (\Exception $e) {
            return $this->errorResponse(null, $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $data = User::with('jabatans.jabatan')->findOrFail($id);
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
            'nama'         => 'required',
            'status'       => 'required|in:1,0',
            'nip'          => ['nullable', Rule::unique('users', 'nip')->ignore($id)],
            'email'        => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
            'no_hp'        => ['nullable', Rule::unique('users', 'no_hp')->ignore($id)],
            'jabatan_id'   => 'nullable|array|min:1',
            'jabatan_id.*' => 'nullable',
        ]);

        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);
            $user->update([
                'nip'    => $validated['nip'],
                'nama'   => $validated['nama'],
                'email'  => $validated['email'],
                'no_hp'  => $validated['no_hp'],
                'status' => $validated['status'],
            ]);

            // Handle jabatan jika ada
            if (isset($validated['jabatan_id'])) {
                // Hapus jabatan yang tidak ada di request
                JabatanUser::where('user_id', $user->id)
                    ->whereNotIn('jabatan_id', $validated['jabatan_id'])
                    ->delete();

                // Tambahkan jabatan baru
                foreach ($validated['jabatan_id'] as $jabatan_id) {
                    JabatanUser::firstOrCreate([
                        'jabatan_id' => $jabatan_id,
                        'user_id'    => $user->id,
                    ]);
                }
            }

            DB::commit();

            return $this->successResponse($user, 'Guru berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse(null, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);

            // Hapus relasi jabatan terlebih dahulu
            JabatanUser::where('user_id', $user->id)->delete();

            // Hapus user
            $user->delete();

            DB::commit();

            return $this->successResponse(null, 'Guru berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse(null, $e->getMessage());
        }
    }

    public function jabatan(string $id)
    {
        try {
            $data = User::where('role', 'guru')->with('jabatans.jabatan')
                ->whereHas('jabatans', function ($query) use ($id) {
                    $query->where('jabatan_id', $id);
                })
                ->get();

            return $this->successResponse($data, 'Data berhasil ditemukan.');
        } catch (\Exception $e) {
            return $this->errorResponse(null, $e->getMessage());
        }
    }

    

}
