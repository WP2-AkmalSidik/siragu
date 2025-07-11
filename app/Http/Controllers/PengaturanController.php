<?php
namespace App\Http\Controllers;

use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengaturanController extends Controller
{
    public function index()
    {
        $data = Pengaturan::first();
        return view('pages.admin.pengaturan.index', compact('data'));
    }

    public function update(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'nama_aplikasi' => 'required',
            'nama_sekolah'  => 'required',
            'singkatan'     => 'nullable',
            'keterangan'    => 'required',
            'logo'          => 'nullable',
        ]);

        DB::beginTransaction();

        try {
            $data = Pengaturan::first();

            if ($data->logo != null && ! Str::endsWith($data->logo, 'logo.png')) {
                Storage::disk('public')->delete('images/' . $data->logo);
            }

            if ($request->hasFile('logo')) {
                $file     = $request->file('logo');
                $filename = 'images/' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images'), $filename);
                $validated['logo'] = $filename;
            } else {
                $validated['logo'] = $data->logo;
            }

            $data->update([
                'nama_aplikasi' => $validated['nama_aplikasi'],
                'singkatan'     => $validated['singkatan'],
                'nama_sekolah'  => $validated['nama_sekolah'],
                'keterangan'    => $validated['keterangan'],
                'logo'          => $validated['logo'],
            ]);

            DB::commit();

            return $this->successResponse(null, 'Pengaturan berhasil diperbaharui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse(null, 'Pengaturan gagal diperbaharui. ' . $e->getMessage());
        }
    }
}
