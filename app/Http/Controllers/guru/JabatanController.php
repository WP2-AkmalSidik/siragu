<?php
namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Jabatan;
use App\Models\JabatanUser;
use App\Models\User;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function form(Request $request, $id)
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
            ])->whereHas('target', function ($query) use ($id) {
                $query->where('jabatan_id', $id);
            })
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
    public function target(Request $request)
    {
        if ($request->ajax() && $request->mode == 'select') {
            // 1. Dapatkan jabatan yang dimiliki pengisi (user yang login)
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

    public function guru(string $id, string $formId)
    {
        try {
            $form = Form::find($formId);

            if (! $form) {
                return $this->errorResponse(null, 'Form not found', 404);
            }

            if ($form->self) {
                $data = User::with('jabatans.jabatan')
                    ->find(auth()->id());

                if (! $data) {
                    return $this->errorResponse(null, 'User not found', 404);
                }

                $data = collect([$data]); // Convert to collection for consistency
            } else {
                $data = User::where('role', 'guru')
                    ->whereHas('jabatans', function ($query) use ($id) {
                        $query->where('jabatan_id', $id);
                    })
                    ->with('jabatans.jabatan')
                    ->get();

                if ($data->isEmpty()) {
                    return $this->errorResponse(null, 'No teachers found for this position', 404);
                }
            }

            return $this->successResponse($data, 'Data berhasil ditemukan.');
        } catch (\Exception $e) {
            return $this->errorResponse(null, $e->getMessage(), 500);
        }
    }
}
