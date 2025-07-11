<?php
namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengaturan::create([
            'nama_aplikasi' => 'Sirakit',
            'keterangan'    => 'Sirakit adalah lorem ipsum dolor sit amet',
            'nama_sekolah'  => 'SD/SMP IT ABU BAKAR ASH-SHIDDIQ',
            'logo'          => 'img/logo.png',
        ]);
    }
}
