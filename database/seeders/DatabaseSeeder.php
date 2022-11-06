<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PeriodeSeeder::class,
            JurusanSeeder::class,
            JamSeeder::class,
            HariSeeder::class,
            DosenSeeder::class,
            MatakuliahSeeder::class,
            KelasSeeder::class,
            MahasiswaSeeder::class,
            MateriSeeder::class,
            AbsensiSeeder::class,
            PengumumanSeeder::class,
            KelasMahasiswaSeeder::class,
            ModuleSeeder::class,
            MahasiswaModuleSeeder::class,
        ]);
    }
}
