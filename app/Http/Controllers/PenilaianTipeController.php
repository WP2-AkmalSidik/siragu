<?php
namespace App\Http\Controllers;

use App\Models\PenilaianTipe;
use App\Traits\JsonResponder;
use Illuminate\Http\Request;

class PenilaianTipeController extends Controller
{
    use JsonResponder;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax() && $request->mode == 'select') {
            $data = PenilaianTipe::all();
            return $this->successResponse(
                $data,
                'Data berhasil ditemukan',
            );
        } else if ($request->ajax()) {

            $tipes = PenilaianTipe::all();

            $data = [
                'view' => view('pages.admin.tipe-penilaian.table', compact('tipes'))->render(),
            ];

            return $this->successResponse($data, 'Data berhasil ditemukan.');
        }
        return view('pages.admin.tipe-penilaian.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'       => 'required',
            'tipe_input' => 'required',
        ]);

        try {
            PenilaianTipe::create([
                'nama'       => $validated['nama'],
                'tipe_input' => $validated['tipe_input'],
            ]);
            return $this->successResponse(null, 'Tipe penilaian berhasil ditambahkan.');
        } catch (\Exception $e) {
            return $this->errorResponse(null, $e->getMessage());
        }
    }
    public function show(string $id)
    {
        $data = PenilaianTipe::with('opsi')->where('id', $id)->first();
        return $this->successResponse($data, 'Data berhasil ditemukan.');
    }
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama'       => 'required',
            'tipe_input' => 'required',
        ]);

        try {
            PenilaianTipe::find($id)->update([
                'nama'       => $validated['nama'],
                'tipe_input' => $validated['tipe_input'],
            ]);
            return $this->successResponse(null, 'Tipe penilaian berhasil diupdate.');
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
            PenilaianTipe::find($id)->delete();
            return $this->successResponse(null, 'Tipe penilaian berhasil dihapus.');
        } catch (\Exception $e) {
            return $this->errorResponse(null, $e->getMessage());
        }
    }
}
