<?php
namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\JabatanUser;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        User::factory(10)->create();

    }
}
