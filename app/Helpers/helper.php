<?php

if (! function_exists('toTitleCase')) {

    function toTitleCase(string $text): string
    {
        return Str::title(str_replace('_', ' ', $text));
    }
}

if (! function_exists('tahunAjaranTerakhir')) {
    function tahunAjaranTerakhir($jumlah = 10): array
    {
        $tahunSekarang = (int) date('Y');
        $bulanSekarang = (int) date('n');

        // Jika bulan sekarang Juli atau setelahnya, maka tahun ajaran dimulai tahun ini
        $tahunMulai = $bulanSekarang >= 7 ? $tahunSekarang : $tahunSekarang - 1;

        $daftar = [];
        for ($i = 0; $i < $jumlah; $i++) {
            $awal     = $tahunMulai - $i;
            $akhir    = $awal + 1;
            $daftar[] = "$awal/$akhir";
        }

        return $daftar;
    }
}

if (! function_exists('tahunAjaranSekarang')) {
    function tahunAjaranSekarang(): string
    {
        $tahun = (int) date('Y');
        $bulan = (int) date('n');

        if ($bulan >= 7) {
            return "$tahun/" . ($tahun + 1);
        } else {
            return ($tahun - 1) . "/$tahun";
        }
    }
}

if (! function_exists('semesterSekarang')) {
    function semesterSekarang(): string
    {
        $bulan = (int) date('n');

        // Anggap Semester Ganjil: Juli - Desember, Genap: Januari - Juni
        return $bulan >= 7 ? 'Ganjil' : 'Genap';
    }
}

if (! function_exists('tanggal_indonesia')) {
    /**
     * Mengubah format timestamp ke tanggal Indonesia
     *
     * @param  mixed  $timestamp
     * @param  bool   $withTime
     * @return string
     */
    function tanggal_indonesia($timestamp, $withTime = false)
    {
        if (empty($timestamp)) {
            return '-';
        }

        // Jika menerima string, konversi ke Carbon
        if (is_string($timestamp)) {
            $timestamp = \Carbon\Carbon::parse($timestamp);
        }

        $bulan = [
            1  => 'Januari',
            2  => 'Februari',
            3  => 'Maret',
            4  => 'April',
            5  => 'Mei',
            6  => 'Juni',
            7  => 'Juli',
            8  => 'Agustus',
            9  => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $tanggal = $timestamp->day;
        $bulan   = $bulan[$timestamp->month];
        $tahun   = $timestamp->year;

        $format = "$tanggal $bulan $tahun";

        if ($withTime) {
            $format .= ' ' . $timestamp->format('H:i:s');
        }

        return $format;
    }
}
