<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SqlFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pathhome = base_path();
        $path = $pathhome.'/public/sql/db_praktikum_prognet_kelompok2.sql';
        $sql = file_get_contents($path);
        DB::unprepared($sql);
    }

}