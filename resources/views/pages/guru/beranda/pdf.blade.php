<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>RAPOT KINERJA GURU/TENAGA KEPENDIDIKAN</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .header h1 {
            font-size: 14px;
            font-weight: bold;
            margin: 0;
            text-decoration: underline;
        }

        .header p {
            margin: 5px 0;
        }

        .info {
            margin-bottom: 15px;
        }

        .info-item {
            display: flex;
            margin-bottom: 3px;
        }

        .info-label {
            width: 120px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .indented {
            padding-left: 20px;
        }

        .footer {
            margin-top: 20px;
        }

        .signature {
            margin-left: 60%;
        }

        .criteria {
            margin-top: 20px;
            font-size: 11px;
        }

        .total-row {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        .predikat-box {
            border: 1px solid black;
            width: 200px;
            padding: 5px;
            margin-top: 10px;
        }

        .tembusan {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div>
            <img src="{{ generateBase64Image(public_path(getPengaturan()->logo)) }}" style="width: 100px; height: auto;">
        </div>
        <h1>RAPOT KINERJA GURU/TENAGA KEPENDIDIKAN</h1>
        <p>{{ getPengaturan()->nama_sekolah }}</p>
        <p>SEMESTER {{ strtoupper($semester) }} TAHUN PELAJARAN {{ $tahun_ajaran }}</p>

    </div>

    <div class="info">
        <div class="info-item">
            <div class="info-label">Nama Guru</div>
            <div>: {{ $guru_nama }}</div>
        </div>
        <div class="info-item">
            <div class="info-label">Mata Pelajaran</div>
            <div>: PJOK</div>
        </div>
        <div class="info-item">
            <div class="info-label">Jabatan</div>
            <div>: </div>
        </div>
    </div>

    <p><strong>INSTRUMEN PENILAIAN</strong></p>

    <table>
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="60%">ASPEK KEGIATAN YANG DINILAI</th>
                <th width="10%">NILAI</th>
                <th width="10%">KET</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalNilai = 0;
                $totalItems = 0;
            @endphp

            @foreach ($result as $index => $item)
                @php
                    $score = $item->rata_nilai ?? '-';
                    $ket = '-';

                    if ($score !== '-') {
                        if ($score >= 89) {
                            $ket = 'SANGAT BAIK';
                        } elseif ($score >= 79) {
                            $ket = 'BAIK';
                        } elseif ($score >= 69) {
                            $ket = 'CUKUP';
                        } elseif ($score >= 51) {
                            $ket = 'KURANG';
                        } else {
                            $ket = 'KURANG SEKALI';
                        }

                        $totalNilai += $score;
                        $totalItems++;
                    }

                    $isSubItem = preg_match('/^[a-z]\./', $item->form_nama);
                @endphp

                <tr>
                    <td>{{ $isSubItem ? '' : $index + 1 }}</td>
                    <td class="{{ $isSubItem ? 'indented' : '' }}">{{ $item->form_nama }}</td>
                    <td align="center">{{ $score }}</td>
                    <td align="center">{{ $ket }}</td>
                </tr>
            @endforeach

            @php
                $rataRata = $totalItems > 0 ? round($totalNilai / $totalItems) : 0;
                $predikat = '-';

                if ($rataRata >= 89) {
                    $predikat = 'SANGAT BAIK';
                } elseif ($rataRata >= 79) {
                    $predikat = 'BAIK';
                } elseif ($rataRata >= 69) {
                    $predikat = 'CUKUP';
                } elseif ($rataRata >= 51) {
                    $predikat = 'KURANG';
                } else {
                    $predikat = 'KURANG SEKALI';
                }
            @endphp

            <tr class="total-row">
                <td colspan="2" align="right">TOTAL</td>
                <td align="center">{{ $rataRata }}</td>
                <td align="center">{{ $predikat }}</td>
            </tr>
        </tbody>
    </table>

    <div class="signature">
        <p>{{ getKepsek()->nama }}</p>
        <img src="{{ generateBase64Image(public_path('storage/' . getKepsek()->ttd)) }}"
            style="width: auto; height: 75px;">
        <p>Rajapolah, .....................</p>
    </div>

    <div class="predikat-box">
        <table>
            <tr>
                <td>NILAI</td>
                <td>PREDIKAT</td>
            </tr>
            <tr>
                <td>{{ $rataRata }}</td>
                <td>{{ $predikat }}</td>
            </tr>
        </table>
    </div>

    <div class="tembusan">
        <p><strong>Tembusan</strong></p>
        <p>1. Ketua Yayasan Abu Bakar Ash-Shiddiq Al-Khairiyyah</p>
        <p>2. SDM Yayasan Abu Bakar Ash-Shiddiq Al-Khairiyyah</p>
        <p>3. File</p>
    </div>

    <div class="criteria">
        <p><strong>Kriteria penilaian!</strong></p>
        <p>*Kategori Nilai Artinya</p>
        <p>Kurang Sekali 0 - 50 Membutuhkan pengawasan terus menerus</p>
        <p>Kurang 51 - 68 Kadang-kadang memerlukan tindak lanjut</p>
        <p>Cukup 69 - 78 Biasanya dapat diandalkan</p>
        <p>Baik 79 - 88 Hanya sedikit memerlukan pengawasan</p>
        <p>Sangat Baik 89 - 100 Sepenuhnya bisa dipercaya dan dapat menjadi contoh bagi pegawai lain*</p>
    </div>
</body>

</html>
