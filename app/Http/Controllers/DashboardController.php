<?php
namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\User;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $gurus         = User::where('role', 'guru')->count();
        $guruThisMonth = User::where('role', 'guru')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        return view('pages.admin.dashboard.index', compact([
            'gurus', 'guruThisMonth',
        ]));
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

    public function statistik(Request $request, string $semester, string $tahun_ajaran)
    {
        if ($request->ajax()) {
            try {
                if (! in_array($semester, ['ganjil', 'genap'])) {
                    throw new \Exception('Semester harus ganjil atau genap');
                }

                $formattedTahunAjaran = str_replace('-', '/', $tahun_ajaran);

                // Ambil semua penilaian untuk menghitung tren sekolah
                $allNilaiSekolah = Nilai::with(['penilaian.form.tipe', 'target'])
                    ->get()
                    ->each(function ($nilai) {
                        $this->hitungNilaiTertimbang($nilai, $nilai->penilaian->form->tipe);
                    });

                // Hitung total nilai tertimbang dan jumlah penilaian per semester
                $groupedBySemester = $allNilaiSekolah->groupBy(function ($item) {
                    return $item->semester . '|' . $item->tahun_ajaran;
                });

                $labels = [];
                $values = [];

                foreach ($groupedBySemester as $key => $items) {
                    [$smt, $ta] = explode('|', $key);

                    // Step 1: Kelompokkan per target dan per form
                    $groupedByTargetAndForm = $items->groupBy(function ($item) {
                        return $item->target_id . '|' . $item->penilaian->form_id;
                    });

                    // Step 2: Hitung rata-rata tiap form
                    $avgPerFormPerTarget = $groupedByTargetAndForm->map(function ($items) {
                        return $items->avg('nilai_tertimbang');
                    });

                    // Step 3: Hitung rata-rata per target (rata-rata semua form)
                    $groupedByTarget = $avgPerFormPerTarget->groupBy(function ($_, $key) {
                        return explode('|', $key)[0]; // target_id
                    });

                    $avgPerTarget = $groupedByTarget->map(function ($formAverages) {
                        return collect($formAverages)->avg();
                    });

                    // Step 4: Hitung rata-rata seluruh target
                    $finalAverage = $avgPerTarget->avg();

                    // dd($finalAverage, $avgPerFormPerTarget, $avgPerTarget);
                    $labels[] = 'Sem ' . ucfirst($smt) . ' ' . substr($ta, 2, 2) . '/' . substr($ta, 7, 2);
                    $values[] = round( $finalAverage, 2);
                }

                // Ambil penilaian yang diberikan oleh user yang login
                $nilaiUser = Nilai::with([
                    'penilaian.form.tipe',
                    'target.jabatans.jabatan',
                    'pengisi',
                ])
                    ->where('semester', $semester)
                    ->where('tahun_ajaran', $formattedTahunAjaran)
                    ->get()
                    ->each(function ($nilai) {
                        $this->hitungNilaiTertimbang($nilai, $nilai->penilaian->form->tipe);
                    });

                if ($nilaiUser->isEmpty()) {
                    return $this->successResponse([
                        'view' => '<div class="text-center py-4 text-gray-500">Data penilaian tidak ditemukan</div>',
                    ], 'Data tidak ditemukan');
                }

                // Kelompokkan berdasarkan target (guru yang dinilai)
                $groupedByTarget = $nilaiUser->groupBy('target_id');

                $targetData = $groupedByTarget->map(function ($items, $targetId) {
                    // Step 1: Group by form
                    $groupedByForm = $items->groupBy('penilaian.form_id');

                    // Step 2: For each form, compute average per pengisi
                    $formAverages = $groupedByForm->map(function ($formItems) {
                        // Group by pengisi
                        $groupedByPengisi = $formItems->groupBy('pengisi_id');

                        // Average per pengisi
                        $avgPerPengisi = $groupedByPengisi->map(function ($pengisiItems) {
                            return $pengisiItems->avg('nilai_tertimbang');
                        });

                        // Average of averages per form
                        return $avgPerPengisi->avg();
                    });

                    // Step 3: Average all form averages for this target
                    $finalAverage = $formAverages->avg();

                    return (object) [
                        'target_id'       => $targetId,
                        'target_nama'     => $items->first()->target->nama ?? 'Unknown',
                        'target_jabatan'  => $items->first()->target->jabatans->first()->jabatan->nama ?? '-',
                        'rata_nilai'      => round($finalAverage, 2),
                        'total_penilaian' => $items->count(),
                    ];
                })->sortByDesc('rata_nilai')->values();

                // Ambil 3 terbaik dan 3 terburuk
                $top3    = $targetData->take(3);
                $bottom3 = $targetData->slice(-3)->reverse()->values();

                // Data untuk chart per target
                $chartTargetLabels = $targetData->pluck('target_nama')->toArray();
                $chartTargetValues = $targetData->pluck('rata_nilai')->toArray();
                $rataNilaiArray    = $targetData->pluck('rata_nilai')->toArray();
                $jumlahTargetData  = count($rataNilaiArray);
                $total             = array_sum($rataNilaiArray);
                $overall_average   = $total / $jumlahTargetData;

                $data = [
                    'overall_average'    => round($overall_average, 2),
                    'highest_score'      => $targetData->max('rata_nilai'),
                    'lowest_score'       => $targetData->min('rata_nilai'),
                    'excellent_teachers' => $targetData->where('rata_nilai', '>=', 85)->count(),
                    'top3'               => $top3,
                    'bottom3'            => $bottom3,
                    'semester'           => ucfirst($semester),
                    'tahun_ajaran'       => $tahun_ajaran,
                    'pengisi_nama'       => auth()->user()->nama,
                    'target_data'        => $targetData,
                ];

                return $this->successResponse([
                    'view'         => view('pages.admin.dashboard.data', $data)->render(),
                    'data'         => $data,
                    'chart'        => [
                        'labels' => $labels,
                        'values' => $values,
                    ],
                    'chart_target' => [
                        'labels' => $chartTargetLabels,
                        'values' => $chartTargetValues,
                    ],
                ], 'Data berhasil ditemukan');

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
