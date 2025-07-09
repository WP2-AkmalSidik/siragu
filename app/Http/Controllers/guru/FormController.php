<?php
namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Response;

class FormController extends Controller
{
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
}
