<?php

use Illuminate\Database\Seeder;
use App\Unit;
use App\User;
use App\ComplainType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $units = [
            ['name' => 'Biro Akademik dan Kemahasiswaan'],
            ['name' => 'Fakultas Ekonomi dan Bisnis'],
            ['name' => 'Fakultas Ilmu Sosial dan Ilmu Politik'],
            ['name' => 'Fakultas Pertanian'],
            ['name' => 'Fakultas Kehutanan'],
            ['name' => 'Fakultas Keguruan dan Ilmu Pendidikan'],
            ['name' => 'Fakultas Perikanan dan Ilmu Kelautan'],
            ['name' => 'Fakultas Matematika dan Ilmu Pengetahuan Alam'],
            ['name' => 'Fakultas Hukum'],
            ['name' => 'Fakultas Teknik'],
            ['name' => 'Fakultas Kedokteran'],
            ['name' => 'Fakultas Ilmu Komputer dan Teknologi Informasi'],
            ['name' => 'Fakultas Kesehatan Masyarakat'],
            ['name' => 'Fakultas Farmasi'],
            ['name' => 'Fakultas Ilmu Budaya'],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);
        }

        $admin = [
            'name' => 'admin',
            'email' => 'admin@email.com',
            'username' => 'admin',
            'password' => bcrypt('admin337865@!&*ADE'),
            'level_user' => 0,
            'unit_id' => 1,
        ];

        User::create($admin);

        $complain_types = [
            ['title' => 'PDDIKTI'],
            ['title' => 'Kinerja Sistem Informasi Akademik'],
            ['title' => 'Wisuda'],
            ['title' => 'Sistem Informasi Akademik'],
            ['title' => 'Lain-lain'],
        ];

        foreach ($complain_types as $complain_type) {
            ComplainType::create($complain_type);
        }
    }
}
