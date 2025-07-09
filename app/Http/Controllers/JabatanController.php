<?php
namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\JabatanUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax() && $request->mode == 'select') {
            $data = Jabatan::all();
            return $this->successResponse(
                $data,
                'Data berhasil ditemukan',
            );
        } else if ($request->ajax()) {

            $jabatans = Jabatan::all();

            $data = [
                'view' => view('pages.admin.guru.jabatan.table', compact('jabatans'))->render(),
            ];

            return $this->successResponse($data, 'Data berhasil ditemukan.');
        }

        return redirect()->back();
    }
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
            Jabatan::create([
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
    public function edit(string $id)
    {
        try {
            $data = Jabatan::find($id);
            return $this->successResponse($data, 'Data berhasil ditemukan.');
        } catch (\Exception $e) {
            return $this->errorResponse(null, $e->getMessage());
        }
    }
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
            Jabatan::find($id)->update([
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
    public function destroy(string $id)
    {
        try {
            Jabatan::find($id)->delete();
            return $this->successResponse(null, 'Guru berhasil dihapus.');
        } catch (\Exception $e) {
            return $this->errorResponse(null, $e->getMessage());
        }
    }

    public function target(Request $request)
    {
        if ($request->ajax() && $request->mode == 'select') {
            $pengisi_jabatan_ids = JabatanUser::where('user_id', auth()->user()->id)->pluck('jabatan_id');

            $target_jabatans = Jabatan::whereHas('target', function ($query) use ($pengisi_jabatan_ids) {
                $query->whereHas('form', function ($q) use ($pengisi_jabatan_ids) {
                    $q->whereHas('pengisi', function ($qry) use ($pengisi_jabatan_ids) {
                        $qry->whereIn('jabatan_id', $pengisi_jabatan_ids);
                    });
                });
            })
                ->select('id', 'jabatan')
                ->distinct()
                ->get();

            return $this->successResponse($target_jabatans, 'Daftar jabatan target berhasil ditemukan');
        }
    }
}
