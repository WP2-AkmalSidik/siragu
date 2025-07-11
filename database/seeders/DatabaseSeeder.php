<?php
namespace Database\Seeders;

use App\Models\Form;
use App\Models\User;
use App\Models\Nilai;
use App\Models\Jabatan;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\FormTarget;
use App\Models\FormPengisi;
use App\Models\JabatanUser;
use Faker\Factory as Faker;
use App\Models\FormPenilaian;
use App\Models\PenilaianOpsi;
use App\Models\PenilaianTipe;
use Illuminate\Database\Seeder;
use Database\Seeders\PengaturanSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $jabatans = [
            'admin',
            'kepala_sekolah',
            'wakasek',
            'thq',
            'guru',
        ];

        User::create([
            'nama'     => 'Admin',
            'email'    => 'admin@gmail.com',
            'role'     => 'admin',
            'password' => bcrypt('123123123'),
        ]);

        $user = User::create([
            'nama'     => 'Ari Zainal Fauziah',
            'email'    => 'arizainalf@gmail.com',
            'role'     => 'guru',
            'password' => bcrypt('123123123'),
        ]);

        foreach ($jabatans as $jabatan) {
            Jabatan::create([
                'jabatan' => $jabatan,
            ]);
        }

        JabatanUser::create([
            'user_id'    => 1,
            'jabatan_id' => 1,
        ]);

        JabatanUser::create([
            'user_id'    => $user->id,
            'jabatan_id' => 5,
        ]);

        $faker = Faker::create();

        $users = User::factory(10)->create();

        foreach ($users as $user) {
            JabatanUser::create([
                'jabatan_id' => '5',
                'user_id'    => $user->id,
            ]);
        }

        $frekuensi = PenilaianTipe::create([
            'nama'       => 'Frekuensi',
            'tipe_input' => 'radio',
        ]);

        PenilaianTipe::create([
            'nama'       => 'Angka',
            'tipe_input' => 'number',
        ]);

        $opsis = ['Sangat Jarang', 'Jarang/Terkadang', 'Sering', 'Sangat Sering'];

        foreach ($opsis as $index => $opsi) {
            PenilaianOpsi::create([
                'penilaian_tipe_id' => $frekuensi->id,
                'label'             => $opsi,
                'value'             => $index + 1,
            ]);
        }

        $form = Form::create([
            'nama'              => 'Kuisioner Kesolehan',
            'self'              => true,
            'keterangan'        => 'Setiap guru mengisi kuesioner mengenai " Kesolihan Pendidik dan tenaga kependidikan"',
            'penilaian_tipe_id' => $frekuensi->id,
        ]);

        FormPengisi::create([
            'jabatan_id' => 5,
            'form_id'    => $form->id,
        ]);

        FormTarget::create([
            'jabatan_id' => 5,
            'form_id'    => $form->id,
        ]);

        $penilaianForm = [
            'Saya mendirikan sholat fardu (wajib) berjamaah di masjid (laki-laki)',
            'Saya mendirikan sholat malam (tahajjud) dan witir',
            'Saya menghayati dan memahami bacaan-bacaan (doa) dalam sholat',
            'Saya membimbing sholat siswa dengan baik dan benar',
            'Saya mendirikan sholat duha',
            'Saya melaksanakan saum Senin-Kamis',
            'Saya melaksanakan saum Ayyamul bidh',
            'Saya melaksanakan saum Puasa Daud',
            'Saya membaca al-Qur\'an Pagi - Petang',
            'Saya membaca al-Qur\'an Pagi',
            'Saya membaca al-Qur\'an Petang',
            'Saya membaca al-Qur\'an dan memahami artinya (terjemah)',
            'Saya melakukan muroja\'ah (mengulangi hafalan di rumah)',
            'Saya membiasakan dzikir pagi dan petang',
            'Saya mengikuti kajian/pengajian di lingkungan rumah',
            'Saya aktif dalam kegiatan pembinaan keagamaan di lingkungan tempat tinggal',
        ];

        $formPenilaianIds = [];

        foreach ($penilaianForm as $penilaian) {
            $created = FormPenilaian::create([
                'form_id' => $form->id,
                'nama'    => $penilaian,
            ]);
            $formPenilaianIds[] = $created->id;
        }

        foreach ($formPenilaianIds as $formPenilaianId) {
            Nilai::create([
                'pengisi_id'        => 2,
                'target_id'         => 2,
                'form_penilaian_id' => $formPenilaianId,
                'nilai'             => 4,
                'tahun_ajaran'      => '2025/2026',
                'semester'          => 'genap',
            ]);
        }

        $this->call(
            PengaturanSeeder::class,
        );
    }
}
