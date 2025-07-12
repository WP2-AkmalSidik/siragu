<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>RAPOT KINERJA GURU/TENAGA KEPENDIDIKAN</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            margin: 1.5cm;
            background: #fff;
            color: #333;
        }

        /* Header Section - Improved Layout */
        .header {
            display: table;
            width: 100%;
            margin-bottom: 25px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }

        .logo-container {
            display: table-cell;
            width: 120px;
            vertical-align: middle;
            text-align: center;
            padding-right: 12px;
        }

        .logo {
            width: 100px;
            height: auto;
            max-height: 100px;
            object-fit: contain;
        }

        .header-text {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
            transform: translateX(-3rem);
            /* Geser 1rem ke kiri */
        }

        .header h1 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
            text-decoration: underline;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #1a1a1a;
        }

        .header .school-name {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #2c3e50;
        }

        .header .semester-info {
            font-size: 12px;
            color: #555;
            font-weight: 500;
        }

        .info {
            margin-bottom: 20px;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 3px;
            border: 1px solid #e0e0e0;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .info-item {
            display: flex;
            align-items: center;
            white-space: nowrap;
        }

        .info-label {
            font-weight: bold;
            color: #2c3e50;
        }

        .info-value {
            color: #555;
            margin-left: 5px;
        }

        /* Section Title */
        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin: 25px 0 15px 0;
            color: #2c3e50;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 11px;
        }

        table,
        th,
        td {
            border: 1px solid #333;
        }

        th {
            background: linear-gradient(135deg, #2c3e50, #913013);
            color: white;
            padding: 8px 5px;
            text-align: center;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
        }

        td {
            padding: 6px 5px;
            vertical-align: middle;
        }

        .indented {
            padding-left: 20px;
            font-style: italic;
        }

        .total-row {
            font-weight: bold;
            background: linear-gradient(135deg, #ecf0f1, #bdc3c7);
            color: #2c3e50;
        }

        .total-row td {
            padding: 8px 5px;
            font-size: 12px;
        }

        /* Footer Section */
        .footer {
            margin-top: 20px;
            position: relative;
            min-height: 120px;
        }

        .signature {
            position: absolute;
            right: 0;
            top: 0;
            width: 200px;
            text-align: left;
            padding: 10px;
        }

        .signature p {
            margin: 5px 0;
            font-size: 11px;
        }

        .signature-img {
            width: auto;
            height: 75px;
            margin: 10px 0;
        }

        .signature .name {
            font-weight: bold;
            margin-top: 5px;
        }

        .signature .date {
            margin-top: 10px;
            color: #666;
        }

        /* Predikat Box */
        .predikat-box {
            position: absolute;
            left: 0;
            top: 0;
            width: 200px;
            border: 2px solid #2c3e50;
            background: #f8f9fa;
            border-radius: 3px;
            overflow: hidden;
            padding: 5px;
        }

        .predikat-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        .predikat-table td {
            border: 1px solid #2c3e50;
            padding: 5px;
            text-align: center;
            font-size: 11px;
        }

        .predikat-table .header-cell {
            background: #2c3e50;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        .predikat-table .value-cell {
            background: white;
            font-weight: bold;
            color: #2c3e50;
        }

        /* Tembusan Section */
        .tembusan {
            margin-top: 140px;
            font-size: 11px;
            padding: 10px;
            background: #f8f9fa;
            border-left: 3px solid #913013;
        }

        .tembusan p {
            margin: 3px 0;
        }

        .tembusan strong {
            color: #2c3e50;
        }

        /* Criteria Section */
        .criteria {
            margin-top: 20px;
            font-size: 10px;
            border-top: 2px solid #913013;
            padding-top: 10px;
            background: #f8f9fa;
            padding: 10px;
            border-radius: 3px;
        }

        .criteria p {
            margin: 3px 0;
        }

        .criteria strong {
            color: #2c3e50;
            font-size: 11px;
        }

        /* Utility Classes */
        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .font-bold {
            font-weight: bold;
        }

        /* Signature Section */
        .signature {
            position: absolute;
            right: 0;
            top: 0;
            width: 250px;
            text-align: center;
            padding: 10px;
        }

        .city-date {
            margin-bottom: 40px;
            font-weight: bold;
            text-transform: capitalize;
        }

        .signature-space {
            min-height: 80px;
            margin-bottom: 5px;
        }

        .empty-signature {
            height: 80px;
            border-bottom: 1px solid #000;
            margin-bottom: 5px;
        }

        .signature-img {
            max-height: 80px;
            margin-bottom: 5px;
        }

        .signature-line {
            margin: 0;
            padding: 0;
        }

        .name {
            margin-top: 5px;
            font-weight: bold;
        }

        .nip {
            margin-top: 5px;
            font-size: 11px;
        }

        /* Print optimizations */
        @media print {
            body {
                margin: 1cm;
            }

            .header {
                page-break-inside: avoid;
            }

            table {
                page-break-inside: avoid;
            }

            .footer {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <div class="header">
        <div class="logo-container">
            <img class="logo" src="{{ generateBase64Image(public_path(getPengaturan()->logo)) }}" alt="Logo Sekolah">
        </div>
        <div class="header-text">
            <h1>Rapot Kinerja Guru/Tenaga Kependidikan</h1>
            <p class="school-name">{{ getPengaturan()->nama_sekolah }}</p>
            <p class="semester-info">SEMESTER {{ strtoupper($semester) }} TAHUN PELAJARAN {{ $tahun_ajaran }}</p>
        </div>
        {{-- <div class="logo-container">
            <img class="logo" src="#" alt="Logo Sekolah">
        </div> --}}
    </div>

    <!-- Information Section -->
    <div class="info">
        <div class="info-item"><span class="info-label">Nama Guru</span><span class="info-value">:
                {{ $guru_nama }}</span></div>
        <div class="info-item"><span class="info-label">Mata Pelajaran</span><span class="info-value">: PJOK</span>
        </div>
        <div class="info-item"><span class="info-label">Jabatan</span><span class="info-value">: Guru</span></div>
    </div>

    <!-- Section Title -->
    <p class="section-title">Instrumen Penilaian</p>

    <!-- Main Table -->
    <table>
        <thead>
            <tr>
                <th width="5%">No.</th>
                <th width="60%">Aspek Kegiatan Yang Dinilai</th>
                <th width="10%">Nilai</th>
                <th width="10%">Ket</th>
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
                    <td class="text-center">{{ $isSubItem ? '' : $index + 1 }}</td>
                    <td class="{{ $isSubItem ? 'indented' : '' }}">{{ $item->form_nama }}</td>
                    <td class="text-center">{{ $score }}</td>
                    <td class="text-center">{{ $ket }}</td>
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
                <td colspan="2" class="text-right font-bold">TOTAL</td>
                <td class="text-center font-bold">{{ $rataRata }}</td>
                <td class="text-center font-bold">{{ $predikat }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Footer Section -->
    <div class="footer">
        <!-- Predikat Box -->
        <div class="predikat-box">
            <table class="predikat-table">
                <tr>
                    <td class="header-cell">NILAI</td>
                    <td class="header-cell">PREDIKAT</td>
                </tr>
                <tr>
                    <td class="value-cell">{{ $rataRata }}</td>
                    <td class="value-cell">{{ $predikat }}</td>
                </tr>
            </table>
        </div>
        <!-- Signature Section -->
        <div class="signature">
            @php
                $bulanIndonesia = [
                    'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember',
                ];
                $bulanSekarang = $bulanIndonesia[date('n') - 1];
            @endphp

            <p class="city-date">Rajapolah, {{ date('d') }} - {{ $bulanSekarang }} - {{ date('Y') }}</p>
            <div class="signature-space">
                @if (auth()->user()->jabatans->contains(fn($j) => $j->jabatan->jabatan == 'kepala_sekolah'))
                    <img class="signature-img"
                        src="{{ generateBase64Image(public_path('storage/' . getKepsek()->ttd)) }}" alt="Tanda Tangan">
                @else
                    <div class="empty-signature"></div>
                @endif
            </div>
            <p class="name">{{ getKepsek()->nama }}</p>
            <p class="signature-line">_________________________</p>
            <p class="nip">NIP. {{ getKepsek()->nip ?? '______________________' }}</p>
        </div>
    </div>

    <!-- Tembusan Section -->
    <div class="tembusan">
        <p><strong>Tembusan</strong></p>
        <p>1. Ketua Yayasan Abu Bakar Ash-Shiddiq Al-Khairiyyah</p>
        <p>2. SDM Yayasan Abu Bakar Ash-Shiddiq Al-Khairiyyah</p>
        <p>3. File</p>
    </div>

    <!-- Criteria Section -->
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
