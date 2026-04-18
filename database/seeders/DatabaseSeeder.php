<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TamanbaliDummySeeder::class,
            // Master data baru
            PrajuruSeeder::class,
            ProfilDesaSeeder::class,
            AwigAwigSeeder::class,
            PanaremSeeder::class,
        ]);
    }
}
