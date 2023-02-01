<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Reseteando tablas
        $this->truncateTables([
            'users',
            'tipo_llamadas',
            'origen_llamadas',
        ]);

        $this->call(TipoLlamadaSeeder::class);
        $this->call(OrigenLlamadaSeeder::class);

    }

    // Método para resetear tablas
    public function truncateTables(array $tables)
    {

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
