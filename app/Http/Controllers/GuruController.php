<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\JsonResponder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GuruController extends Controller
{
    use JsonResponder;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax() && $request->mode == 'select') {
            $data = User::where('role', 'guru')->get();
            return $this->successResponse(
                $data,
                'Data berhasil ditemukan',
            );
        } else if ($request->ajax()) {
            $perPages = 5;
            $query    = User::where('role', 'guru');

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
            'nip'    => 'nullable|unique:users,nip',
            'nama'   => 'required',
            'email'  => 'required|email|unique:users,email',
            'no_hp'  => 'nullable|unique:users,no_hp',
            'status' => 'required|in:1,0',
        ]);

        try {
            User::create([
                'nip'      => $validated['nip'],
                'nama'     => $validated['nama'],
                'email'    => $validated['email'],
                'no_hp'    => $validated['no_hp'],
                'role'     => 'guru',
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
            'nip'    => ['nullable', Rule::unique('users', 'nip')->ignore($id)],
            'email'  => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
            'no_hp'  => ['nullable', Rule::unique('users', 'no_hp')->ignore($id)],
        ]);

        try {
            User::find($id)->update([
                'nip'    => $validated['nip'],
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
}
