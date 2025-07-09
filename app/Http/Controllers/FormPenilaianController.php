<?php
namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormKategori;
use App\Models\FormPengisi;
use App\Models\FormPenilaian;
use App\Models\FormSubKategori;
use App\Models\FormTarget;
use App\Models\JabatanUser;
use App\Traits\JsonResponder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class FormPenilaianController extends Controller
{
    use JsonResponder;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax() && $request->mode == 'select') {
            $data = Form::with([
                'penilaianLangsung',
                'kategori' => function ($query) {
                    $query->with(['penilaian', 'subKategori.penilaian']);
                },
                'kategori.subKategori',
                'pengisi.jabatan', 'target.jabatan',
            ])->get();
            return $this->successResponse(
                $data,
                'Data berhasil ditemukan',
            );
        } else if ($request->ajax()) {
            $query = Form::with([
                'penilaianLangsung',
                'kategori' => function ($query) {
                    $query->with(['penilaian', 'subKategori.penilaian']);
                },
                'kategori.subKategori',
                'pengisi.jabatan', 'target.jabatan',
            ]);

            if ($request->has('search') && $request->search != '') {
                $query->where('nama', 'like', '%' . $request->search . '%');
            }

            $forms = $query->orderBy('created_at', 'desc')
                ->get();

            $data = [
                'view' => view('pages.admin.formulir.data', compact('forms'))->render(),
            ];

            return $this->successResponse($data, 'Data berhasil ditemukan.');
        }
        return view('pages.admin.formulir.index');
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
            'nama'                                       => 'required',
            'self'                                       => 'nullable',
            'pengisi'                                    => 'required|exists:jabatans,id',
            'target'                                     => 'required|exists:jabatans,id',
            'keterangan'                                 => 'nullable',
            'penilaian_tipe_id'                          => 'required',
            'kategori'                                   => 'nullable|array',
            'kategori.*'                                 => 'nullable',
            'kategori.*.nama'                            => 'required_with:kategori.*',
            'kategori.*.penilaian'                       => 'nullable|array', // Penilaian langsung di kategori
            'kategori.*.penilaian.*'                     => 'nullable',
            'kategori.*.penilaian.*.nama'                => 'required',
            'kategori.*.sub_kategori'                    => 'nullable|array',
            'kategori.*.sub_kategori.*'                  => 'nullable',
            'kategori.*.sub_kategori.*.nama'             => 'required_with:kategori.*.sub_kategori.*',
            'kategori.*.sub_kategori.*.penilaian'        => 'nullable|array',
            'kategori.*.sub_kategori.*.penilaian.*'      => 'nullable',
            'kategori.*.sub_kategori.*.penilaian.*.nama' => 'required',
            'penilaian'                                  => 'nullable|array', // Penilaian langsung tanpa kategori
            'penilaian.*'                                => 'nullable',
            'penilaian.*.nama'                           => 'required',
        ],
            [
                'penilaian_tipe_id.required' => 'Tipe penilaian harus diisi',
            ]);

        DB::beginTransaction();

        try {
            $form = Form::create([
                'nama'              => $validated['nama'],
                'self'              => $validated['self'],
                'keterangan'        => $validated['keterangan'],
                'penilaian_tipe_id' => $validated['penilaian_tipe_id'],
            ]);

            FormPengisi::create([
                'form_id'    => $form->id,
                'jabatan_id' => $validated['pengisi'],
            ]);

            FormTarget::create([
                'form_id'    => $form->id,
                'jabatan_id' => $validated['target'],
            ]);

            // 1. Penilaian langsung tanpa kategori dan sub kategori
            if (! empty($validated['penilaian']) && is_array($validated['penilaian'])) {
                foreach ($validated['penilaian'] as $penilaianData) {
                    FormPenilaian::create([
                        'form_id'              => $form->id,
                        'form_kategori_id'     => null,
                        'form_sub_kategori_id' => null,
                        'nama'                 => $penilaianData['nama'],
                        // 'penilaian_tipe_id'    => $validated['penilaian_tipe_id'],
                    ]);
                }
            }

            // 2. Penilaian dengan kategori (dengan atau tanpa sub kategori)
            if (! empty($validated['kategori']) && is_array($validated['kategori'])) {
                foreach ($validated['kategori'] as $kategoriData) {
                    $kategori = FormKategori::create([
                        'form_id'  => $form->id,
                        'kategori' => $kategoriData['nama'],
                    ]);

                    // Penilaian langsung di kategori (tanpa sub kategori)
                    if (! empty($kategoriData['penilaian']) && is_array($kategoriData['penilaian'])) {
                        foreach ($kategoriData['penilaian'] as $penilaianData) {
                            FormPenilaian::create([
                                'form_id'              => $form->id,
                                'form_kategori_id'     => $kategori->id,
                                'form_sub_kategori_id' => null,
                                'nama'                 => $penilaianData['nama'],
                                // 'penilaian_tipe_id'    => $validated['penilaian_tipe_id'],
                            ]);
                        }
                    }

                    // Penilaian dengan sub kategori
                    if (! empty($kategoriData['sub_kategori']) && is_array($kategoriData['sub_kategori'])) {
                        foreach ($kategoriData['sub_kategori'] as $subKategoriData) {
                            $subKategori = FormSubKategori::create([
                                'form_id'          => $form->id,
                                'form_kategori_id' => $kategori->id,
                                'sub_kategori'     => $subKategoriData['nama'],
                            ]);

                            if (! empty($subKategoriData['penilaian']) && is_array($subKategoriData['penilaian'])) {
                                foreach ($subKategoriData['penilaian'] as $penilaianData) {
                                    FormPenilaian::create([
                                        'form_id'              => $form->id,
                                        'form_kategori_id'     => $kategori->id,
                                        'form_sub_kategori_id' => $subKategori->id,
                                        'nama'                 => $penilaianData['nama'],
                                        // 'penilaian_tipe_id'    => $validated['penilaian_tipe_id'],
                                    ]);
                                }
                            }
                        }
                    }
                }
            }

            DB::commit();

            return $this->successResponse(null, 'Form berhasil disimpan.');
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
            $form = Form::with([
                'penilaianLangsung',
                'kategori' => function ($query) {
                    $query->with(['penilaian', 'subKategori.penilaian']);
                },
                'kategori.subKategori',
                'tipe.opsi',
            ])->findOrFail($id);

            $responseData = [
                'id'                 => $form->id,
                'nama'               => $form->nama,
                'penilaian_tipe_id'  => $form->penilaian_tipe_id,
                'tipe_penilaian'     => $form->tipe ? [
                    'id'         => $form->tipe->id,
                    'nama'       => $form->tipe->nama,
                    'tipe_input' => $form->tipe->tipe_input,
                ] : null,
                'keterangan'         => $form->keterangan,
                'opsi'               => $form->tipe->opsi,
                'created_at'         => $form->created_at,
                'penilaian_langsung' => $form->penilaianLangsung->map(function ($item) {
                    return [
                        'id'   => $item->id,
                        'nama' => $item->nama,
                    ];
                }),
                'kategori'           => $form->kategori->map(function ($kategori) {
                    return [
                        'id'           => $kategori->id,
                        'kategori'     => $kategori->kategori,
                        'deskripsi'    => $kategori->deskripsi,
                        'penilaian'    => $kategori->penilaian
                            ->where('form_sub_kategori_id', null)
                            ->values()
                            ->map(function ($item) {
                                return [
                                    'id'   => $item->id,
                                    'nama' => $item->nama,
                                ];
                            }),
                        'sub_kategori' => $kategori->subKategori->map(function ($sub) {
                            return [
                                'id'           => $sub->id,
                                'sub_kategori' => $sub->sub_kategori,
                                'deskripsi'    => $sub->deskripsi,
                                'penilaian'    => $sub->penilaian->map(function ($item) {
                                    return [
                                        'id'   => $item->id,
                                        'nama' => $item->nama,
                                    ];
                                }),
                            ];
                        }),
                    ];
                }),
            ];

            return $this->successResponse($responseData, 'Data formulir berhasil ditemukan');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse(null, 'Formulir tidak ditemukan', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->errorResponse(null, 'Terjadi kesalahan server: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $form = Form::with([
                'penilaianLangsung',
                'kategori' => function ($query) {
                    $query->with(['penilaian', 'subKategori.penilaian']);
                },
                'kategori.subKategori',
                'tipe',
            ])->findOrFail($id);

            $responseData = [
                'id'                 => $form->id,
                'nama'               => $form->nama,
                'penilaian_tipe_id'  => $form->penilaian_tipe_id,
                'pengisi'            => $form->pengisi->jabatan->id,
                'target'             => $form->target->jabatan->id,
                'tipe_penilaian'     => $form->tipePenilaian ? [
                    'id'         => $form->tipePenilaian->id,
                    'nama'       => $form->tipePenilaian->nama,
                    'tipe_input' => $form->tipePenilaian->tipe_input,
                ] : null,
                'keterangan'         => $form->keterangan,
                // 'penilaian_tipe_id'  => $form->penilaian_tipe_id,
                'penilaian_langsung' => $form->penilaianLangsung->map(function ($item) {
                    return [
                        'id'   => $item->id,
                        'nama' => $item->nama,
                    ];
                }),
                'kategori'           => $form->kategori->map(function ($kategori) {
                    return [
                        'id'           => $kategori->id,
                        'kategori'     => $kategori->kategori,
                        'deskripsi'    => $kategori->deskripsi,
                        'penilaian'    => $kategori->penilaian->map(function ($item) {
                            return [
                                'id'   => $item->id,
                                'nama' => $item->nama,
                            ];
                        }),
                        'sub_kategori' => $kategori->subKategori->map(function ($sub) {
                            return [
                                'id'           => $sub->id,
                                'sub_kategori' => $sub->sub_kategori,
                                'deskripsi'    => $sub->deskripsi,
                                'penilaian'    => $sub->penilaian->map(function ($item) {
                                    return [
                                        'id'   => $item->id,
                                        'nama' => $item->nama,
                                    ];
                                }),
                            ];
                        }),
                    ];
                }),
            ];

            return $this->successResponse($responseData, 'Data formulir berhasil ditemukan');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->errorResponse(null, 'Formulir tidak ditemukan', Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->errorResponse(null, 'Terjadi kesalahan server: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
        try {
            $form = Form::findOrFail($id);
            $form->delete(); // Akan otomatis menghapus relasi yang memiliki cascade

            return $this->successResponse(null, 'Form berhasil dihapus.');
        } catch (\Exception $e) {
            return $this->errorResponse(null, 'Gagal menghapus form: ' . $e->getMessage());
        }
    }

    public function jabatan(Request $request, string $id)
    {
        $pengisi_jabatan_ids = JabatanUser::where('user_id', auth()->id())
            ->pluck('jabatan_id')
            ->toArray();

        if ($request->ajax() && $request->mode == 'select') {
            $data = Form::with([
                'penilaianLangsung',
                'kategori' => function ($query) {
                    $query->with(['penilaian', 'subKategori.penilaian']);
                },
                'kategori.subKategori',
                'pengisi.jabatan',
                'target.jabatan',
            ])
            // Filter form yang targetnya memiliki jabatan_id = $id
                ->whereHas('target', function ($query) use ($id) {
                    $query->where('jabatan_id', $id);
                })
            // Filter form yang pengisinya memiliki jabatan_id yang diizinkan
                ->whereHas('pengisi', function ($query) use ($pengisi_jabatan_ids) {
                    $query->whereIn('jabatan_id', $pengisi_jabatan_ids);
                })
                ->get()
                ->map(function ($form) {
                    // Tambahkan informasi tambahan
                    $form->pengisi_jabatan = $form->pengisi->jabatan ?? null;
                    $form->target_jabatan  = $form->target->jabatan ?? null;
                    return $form;
                });

            return $this->successResponse($data, 'Data berhasil ditemukan');
        }
    }
    public function formPengisi(Request $request)
    {
        $pengisi_jabatan_ids = JabatanUser::where('user_id', auth()->id())
            ->pluck('jabatan_id')
            ->toArray();

        if ($request->ajax() && $request->mode == 'select') {
            // dd($pengisi_jabatan_ids);
            $data = Form::whereHas('pengisi', function ($query) use ($pengisi_jabatan_ids) {
                $query->whereIn('jabatan_id', $pengisi_jabatan_ids);
            })
                ->get()
                ->map(function ($form) {
                    // Tambahkan informasi tambahan
                    $form->pengisi_jabatan = $form->pengisi->jabatan ?? null;
                    $form->target_jabatan  = $form->target->jabatan ?? null;
                    return $form;
                });

            return $this->successResponse($data, 'Data berhasil ditemukan');
        }
    }
}
