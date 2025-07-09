<?php
namespace Database\Seeders;

use App\Models\Form;
use App\Models\FormPengisi;
use App\Models\FormPenilaian;
use App\Models\FormTarget;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Jabatan;
use App\Models\JabatanUser;
use App\Models\PenilaianOpsi;
use App\Models\PenilaianTipe;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

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

        foreach ($jabatans as $jabatan) {
            Jabatan::create([
                'jabatan' => $jabatan,
            ]);
        }

        JabatanUser::create([
            'user_id'    => 1,
            'jabatan_id' => 1,
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
            'jabatan_id' => 1,
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

        foreach ($penilaianForm as $penilaian) {
            FormPenilaian::create([
                'form_id' => $form->id,
                'nama'    => $penilaian,
            ]);
        }

    }
}
