<?php
namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PenilaianController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax() && $request->mode == 'select') {
            $data = Nilai::with(['penilaian.form', 'target.jabatan', 'pengisi.jabatan'])
                ->where('pengisi_id', auth()->id())
                ->get()
                ->groupBy(['penilaian.form.id', 'target_id']);

            return $this->successResponse($data, 'Data berhasil ditemukan');
        }

        if ($request->ajax()) {
            $perPage = $request->perPage ?? 10;
            $userId  = auth()->id();

            // Ambil semua nilai yang diisi oleh user login
            $query = Nilai::with(['penilaian.form.tipe', 'target.jabatans.jabatan'])
                ->where('pengisi_id', $userId);

            // Filter form
            if ($request->filled('form')) {
                $query->whereHas('penilaian.form', function ($q) use ($request) {
                    $q->where('id', $request->form);
                });
            }

            // Filter search target
            if ($request->filled('search')) {
                $query->whereHas('target', function ($q) use ($request) {
                    $q->where('nama', 'like', '%' . $request->search . '%');
                });
            }

            // Ambil semua dulu (karena kita akan groupBy di PHP)
            $allNilai = $query->get();

            // Kelompokkan berdasarkan target+form
            $grouped = $allNilai->groupBy(function ($item) {
                return $item->target_id . '-' . $item->penilaian->form_id;
            });

            // Bentuk koleksi data siap dipakai
            $result = $grouped->map(function ($items) {
                $first = $items->first();

                // Hitung nilai tertimbang
                $items->each(function ($nilai) {
                    $this->hitungNilaiTertimbang($nilai, $nilai->penilaian->form->tipe);
                });

                $target = $first->target;

                return (object) [
                    'target_id'       => $target->id,
                    'target_nama'     => $target->nama,
                    'form_id'         => $first->penilaian->form->id,
                    'form_nama'       => $first->penilaian->form->nama,
                    'jabatan_list'    => $target->jabatans->map(fn($j) => toTitleCase($j->jabatan->jabatan))->implode(', '),
                    'rata_nilai'      => $items->avg('nilai_tertimbang'),
                    'total_penilaian' => $items->count(),
                    'tahun_ajaran'    => $first->tahun_ajaran ?? '-',
                    'semester'        => $first->semester ?? '-',
                ];
            })->values();

            // Manual Pagination
            $page  = LengthAwarePaginator::resolveCurrentPage();
            $total = $result->count();
            $items = $result->forPage($page, $perPage)->values();

            $paginated = new LengthAwarePaginator($items, $total, $perPage, $page, [
                'path'  => LengthAwarePaginator::resolveCurrentPath(),
                'query' => $request->query(),
            ]);

            // Render view
            $data = [
                'view'       => view('pages.guru.penilaian.card', ['targets' => $paginated])->render(),
                'pagination' => (string) $paginated->links('vendor.pagination.tailwind'),
            ];

            return $this->successResponse($data, 'Data berhasil ditemukan');
        }

        return view('pages.guru.penilaian.index');
    }

    protected function hitungNilaiTertimbang($nilai, $tipe)
    {
        if (empty($nilai->nilai)) {
            $nilai->nilai_tertimbang           = 0;
            $nilai->nilai_tertimbang_formatted = '0';
            return;
        }

        $nilaiNumerik = (float) $nilai->nilai;

        switch ($tipe->tipe_input) {
            case 'radio':
            case 'select':

                $maxPossible                       = $tipe->opsi->max('value');
                $nilai->nilai_tertimbang           = ($nilaiNumerik / $maxPossible) * 100;
                $nilai->nilai_tertimbang_formatted = number_format($nilai->nilai_tertimbang);

                break;

            default:
                $nilai->nilai_tertimbang           = $nilaiNumerik;
                $nilai->nilai_tertimbang_formatted = number_format($nilaiNumerik);
        }
    }

    protected function formatNilaiOutput($nilai, $tipe)
    {
        if ($tipe->tipe_input === 'radio' || $tipe->tipe_input === 'select') {
            if ($tipe->nama === 'Frekuensi') {
                return number_format($nilai);
            }
            $opsi = $tipe->opsi->firstWhere('value', round($nilai));
            return $opsi ? $opsi->label : number_format($nilai);
        }
        return number_format($nilai);
    }

    public function create()
    {
        return view('pages.guru.penilaian.tambah');
    }

    public function edit($tahun, $semester, $form, $id)
    {
        // dd($tahun, $semester, $form, $id);
        $tahunAjaran = str_replace('-', '/', $tahun);
        $nilais      = Nilai::with([
            'penilaian.form.tipe.opsi',
            'penilaian.form.target.jabatan',
            'target.jabatans',
            'pengisi',
            'penilaian.kategori',
            'penilaian.subKategori',
        ])
            ->where('tahun_ajaran', $tahunAjaran)
            ->where('semester', $semester)
            ->where('target_id', $id)
            ->where('pengisi_id', auth()->user()->id)
            ->whereHas('penilaian', function ($query) use ($form) {
                $query->whereHas('form', function ($q) use ($form) {
                    $q->where('id', $form);
                });
            })
            ->get();

        // dd($nilais);

        return view('pages.guru.penilaian.edit', compact('nilais'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'      => 'required|exists:users,id', // yang dinilai
            'tahun_ajaran' => 'required|string',
            'semester'     => 'required|string',
            'penilaian'    => 'required|array',
            'penilaian.*'  => 'required|string', // atau nullable jika boleh kosong
        ]);

        DB::beginTransaction();

        try {
            foreach ($validated['penilaian'] as $penilaianId => $nilai) {
                DB::table('nilais')->insert([
                    'form_penilaian_id' => $penilaianId,
                    'pengisi_id'        => auth()->id(),
                    'target_id'         => $validated['user_id'],
                    'semester'          => $validated['semester'],
                    'nilai'             => $nilai,
                    'tahun_ajaran'      => $validated['tahun_ajaran'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Penilaian berhasil disimpan.',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan penilaian.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'nilai'   => 'required|array',
            'nilai.*' => 'nullable|numeric|min:0|max:100',
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->nilai as $id => $value) {
                $nilai = Nilai::find($id);
                if ($nilai) {
                    $nilai->nilai = $value;
                    $nilai->save();
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Nilai berhasil diperbarui.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui nilai: ' . $e->getMessage(),
            ], 500);
        }
    }
    public function destroy($tahun, $semester, $form, $id)
    {
        $tahunAjaran = str_replace('-', '/', $tahun);

        DB::beginTransaction();

        try {
            Nilai::where('tahun_ajaran', $tahunAjaran)
                ->where('semester', $semester)
                ->where('target_id', $id)
                ->where('pengisi_id', auth()->user()->id)
                ->whereHas('penilaian', function ($query) use ($form) {
                    $query->whereHas('form', function ($q) use ($form) {
                        $q->where('id', $form);
                    });
                })
                ->delete();

            DB::commit();

            return $this->successResponse(null, 'Formulir berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->errorResponse(null, 'Formulir Gagal dihapus');
        }
    }
}
