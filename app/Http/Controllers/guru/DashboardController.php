<?php
namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.guru.beranda.index');
    }

    public function generateRaporPdf(string $semester, string $tahun_ajaran)
    {
        try {
            // Validasi parameter input
            if (! in_array($semester, ['ganjil', 'genap'])) {
                throw new \Exception('Semester harus ganjil atau genap');
            }

            // Format tahun ajaran
            $formattedTahunAjaran = str_replace('-', '/', $tahun_ajaran);

            // Query data nilai
            $query = Nilai::with([
                'penilaian.form.tipe',
                'target.jabatans.jabatan',
                'pengisi',
            ])
                ->where('target_id', auth()->user()->id)
                ->where('semester', $semester)
                ->where('tahun_ajaran', $formattedTahunAjaran);

            $allNilai = $query->get();

            if ($allNilai->isEmpty()) {
                return response()->json(['error' => 'Data penilaian tidak ditemukan'], 404);
            }

            // Proses pengelompokan dan perhitungan
            $grouped = $allNilai->groupBy(function ($item) {
                return $item->target_id . '-' . $item->penilaian->form_id;
            });

            $result = $grouped->map(function ($items, $key) {
                $first = $items->first();

                // Hitung skor tertimbang
                $items->each(function ($nilai) {
                    $this->hitungNilaiTertimbang($nilai, $nilai->penilaian->form->tipe);
                });

                $totalPenilaian    = $items->count();
                $totalSkorMaksimum = $totalPenilaian * 100;

                return (object) [
                    'form_id'             => $first->penilaian->form->id,
                    'form_nama'           => $first->penilaian->form->nama,
                    'keterangan'          => $first->penilaian->form->keterangan ?? '-',
                    'rata_nilai'          => round($items->avg('nilai_tertimbang'), 2),
                    'total_penilaian'     => $totalPenilaian,
                    'total_skor_maksimum' => $totalSkorMaksimum,
                    'tahun_ajaran'        => $first->tahun_ajaran ?? '-',
                    'semester'            => ucfirst($first->semester) ?? '-',
                ];
            })->values();

            // Konfigurasi Dompdf
            $options = new Options();
            $options->set('isRemoteEnabled', true);
            $options->set('defaultFont', 'Arial');

            $dompdf = new Dompdf($options);

            // Render view ke HTML
            $html = view('pages.guru.beranda.pdf', [
                'result'       => $result,
                'semester'     => ucfirst($semester),
                'tahun_ajaran' => $tahun_ajaran,
                'guru_nama'    => $allNilai->first()->target->nama ?? 'Unknown',
            ])->render();

            // Load HTML ke Dompdf
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            // Generate nama file
            $filename = 'rapor_' . auth()->user()->nama . '_' . $semester . '_' . $tahun_ajaran . '.pdf';

            // Stream file ke browser
            return $dompdf->stream($filename);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function rapor(Request $request, string $semester, string $tahun_ajaran)
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
                    ->where('target_id', auth()->user()->id)
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

                    // Hitung skor tertimbang per nilai
                    $items->each(function ($nilai) {
                        $this->hitungNilaiTertimbang($nilai, $nilai->penilaian->form->tipe);
                    });

                    $totalPenilaian = $items->count();

                    $totalSkorMaksimum = $totalPenilaian * 100;

                    return (object) [
                        'form_id'             => $first->penilaian->form->id,
                        'form_nama'           => $first->penilaian->form->nama,
                        'keterangan'          => $first->penilaian->form->keterangan ?? '-',
                        'rata_nilai'          => round($items->avg('nilai_tertimbang'), 2),
                        'total_penilaian'     => $totalPenilaian,
                        'total_skor_maksimum' => $totalSkorMaksimum,
                        'tahun_ajaran'        => $first->tahun_ajaran ?? '-',
                        'semester'            => ucfirst($first->semester) ?? '-',
                    ];
                })->values();

                // Prepare data for view
                $data = [
                    'view' => view('pages.guru.beranda.data', [
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
