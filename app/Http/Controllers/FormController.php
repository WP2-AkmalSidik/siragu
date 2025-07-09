<?php
namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormKategori;
use App\Models\FormPenilaian;
use App\Models\FormSubKategori;
use App\Traits\JsonResponder;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    {dd($request->all());
        $validated = $request->validate([
            'nama'                                            => 'required',
            'desripsi'                                        => 'nullable',
            'status'                                          => 'required',
            'kategori'                                        => 'nullable|array|min:1',
            'kategori.*'                                      => 'nullable',
            'kategori.*.nama'                                 => 'required',
            'kategori.*.deskripsi'                            => 'nullable',
            'kategori.*.sub_kategori'                         => 'nullable|array|min:1',
            'kategori.*.sub_kategori.*'                       => 'nullable',
            'kategori.*.sub_kategori.*.nama'                  => 'required',
            'kategori.*.sub_kategori.*.deskripsi'             => 'nullable',
            'kategori.*.sub_kategori.*.penilaian'             => 'nullable|array|min:1',
            'kategori.*.sub_kategori.*.penilaian.*'           => 'nullable',
            'kategori.*.sub_kategori.*.penilaian.*.nama'      => 'required',
            'kategori.*.sub_kategori.*.penilaian.*.type'      => 'required|in:1,2',
            'kategori.*.sub_kategori.*.penilaian.*.deskripsi' => 'nullable',
            'kategori.*.sub_kategori.*.penilaian.*.bobot'     => 'required|numeric',
        ]);

        try {
            $form = Form::create([
                'nama'     => $validated['nama'],
                'desripsi' => $validated['desripsi'],
                'status'   => $validated['status'],
            ]);

            foreach ($validated['kategori'] as $kategori) {
                $kategori = FormKategori::create([
                    'form_id'   => $form->id,
                    'nama'      => $kategori['nama'],
                    'deskripsi' => $kategori['deskripsi'],
                ]);

                foreach ($kategori['sub_kategori'] as $subKategori) {
                    $subKategori = FormSubKategori::create([
                        'form_id'     => $form->id,
                        'kategori_id' => $kategori->id,
                        'nama'        => $subKategori['nama'],
                        'deskripsi'   => $subKategori['deskripsi'],
                    ]);

                    foreach ($subKategori['penilaian'] as $penilaian) {
                        FormPenilaian::create([
                            'form_id'         => $form->id,
                            'kategori_id'     => $kategori->id,
                            'sub_kategori_id' => $form->id,
                            'nama'            => $penilaian['nama'],
                            'type'            => $penilaian['type'],
                            'deskripsi'       => $penilaian['deskripsi'],
                            'bobot'           => $penilaian['bobot'],
                        ]);
                    }
                }
            }

            return $this->successResponse(null, 'Form berhasil disimpan.');
        } catch (\Exception $e) {
            return $this->errorResponse(null, $e->getMessage());
        }}

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
