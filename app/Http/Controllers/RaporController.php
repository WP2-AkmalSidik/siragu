<?php
namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;

class RaporController extends Controller
{
    public function rapor(Request $request, string $guru_id, string $semester, string $tahun_ajaran)
    {
        if ($request->ajax()) {
            try {
                // Validate input parameters
                if (! in_array($semester, ['ganjil', 'genap'])) {
                    throw new \Exception('Semester harus ganjil atau genap');
                }

                // Format tahun ajaran (from '2023-2024' to '2023/2024')
                $formattedTahunAjaran = str_replace('-', '/', $tahun_ajaran);

                // Get all assessments for the specified teacher, semester, and academic year
                $query = Nilai::with([
                    'penilaian.form.tipe',
                    'target.jabatans.jabatan',
                    'pengisi', // Include assessor information
                ])
                    ->where('target_id', $guru_id)
                    ->where('semester', $semester)
                    ->where('tahun_ajaran', $formattedTahunAjaran);

                // Get all data (we'll group in PHP for more flexibility)
                $allNilai = $query->get();

                // dd($allNilai);

                if ($allNilai->isEmpty()) {
                    return $this->successResponse([
                        'view' => '<div class="text-center py-4 text-gray-500">Data penilaian tidak ditemukan</div>',
                    ], 'Data tidak ditemukan');
                }

                // Group by target+form combination
                $grouped = $allNilai->groupBy(function ($item) {
                    return $item->target_id . '-' . $item->penilaian->form_id;
                });

                // Process each group
                $result = $grouped->map(function ($items, $key) {
                    $first = $items->first();

                    // Calculate weighted scores
                    $items->each(function ($nilai) {
                        $this->hitungNilaiTertimbang($nilai, $nilai->penilaian->form->tipe);
                    });

                    return (object) [
                        'form_id'         => $first->penilaian->form->id,
                        'form_nama'       => $first->penilaian->form->nama,
                        'keterangan'      => $first->penilaian->form->keterangan ?? '-',
                        'rata_nilai'      => round($items->avg('nilai_tertimbang'), 2),
                        'total_penilaian' => $items->count(),
                        'tahun_ajaran'    => $first->tahun_ajaran ?? '-',
                        'semester'        => ucfirst($first->semester) ?? '-',
                    ];
                })->values();

                // Prepare data for view
                $data = [
                    'view' => view('pages.admin.rapor.card', [
                        'result'       => $result,
                        'semester'     => ucfirst($semester),
                        'tahun_ajaran' => $tahun_ajaran,
                        'guru_nama'    => $allNilai->first()->target->nama ?? 'Unknown',
                    ])->render(),
                ];

                return $this->successResponse($data, 'Data berhasil ditemukan');

            } catch (\Exception $e) {
                return $this->errorResponse($e->getMessage(), 400);
            }
        }
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
}
