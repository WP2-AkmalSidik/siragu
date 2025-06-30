<?php
namespace App\Http\Controllers;

use App\Models\PenilaianOpsi;
use App\Traits\JsonResponder;
use Illuminate\Http\Request;

class PenilaianOpsiController extends Controller
{
    use JsonResponder;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax() && $request->mode == 'select') {
            $data = PenilaianOpsi::all();
            return $this->successResponse(
                $data,
                'Data berhasil ditemukan',
            );
        } else if ($request->ajax()) {
            $perPages = 10;
            $query    = PenilaianOpsi::with('tipe');

            if ($request->has('search') && $request->search != '') {
                $query->where('label', 'like', '%' . $request->search . '%')->orWhereHas('tipe', function ($q) use ($request) {
                    $q->where('nama', 'like', '%' . $request->search . '%');
                });
            }

            if ($request->filled('perPage') && $request->perPage != '') {
                $perPages = $request->perPage;
            }

            $opsis = $query->orderBy('created_at')->paginate($perPages);

            $data = [
                'view'       => view('pages.admin.tipe-penilaian.opsi.table', compact('opsis'))->render(),
                'pagination' => (string) $opsis->links('vendor.pagination.tailwind'),
            ];

            return $this->successResponse($data, 'Data berhasil ditemukan.');
        }

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'penilaian_tipe_id' => 'required|exists:penilaian_tipes,id',
            'label'             => 'required',
            'value'             => 'required',
        ]);

        try {
            PenilaianOpsi::create($validated);
            return $this->successResponse(null, 'Opsi penilaian berhasil ditambahkan.');
        } catch (\Exception $e) {
            return $this->errorResponse(null, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = PenilaianOpsi::find($id);
        return $this->successResponse($data, 'Data berhasil ditemukan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'penilaian_tipe_id' => 'required|exists:penilaian_tipes,id',
            'label'             => 'required',
            'value'             => 'required',
        ]);

        try {
            $opsi = PenilaianOpsi::findOrFail($id);
            $opsi->update($validated);

            return $this->successResponse(null, 'Opsi penilaian berhasil diperbarui.');
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
            $data = PenilaianOpsi::find($id);
            $data->delete();

            return $this->successResponse(null, 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return $this->errorResponse(null, 'Gagal menghapus data ' . $e->getMessage());
        }
    }
}
