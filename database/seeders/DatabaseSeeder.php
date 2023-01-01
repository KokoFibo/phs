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
        \App\Models\DataPelita::factory(500)->create();
        // \App\Models\User::factory(10)->create();

        DB::table('panditas')->insert(
            [
            'nama_pandita' => 'Huang TCS',
            'pandita_is_used' => false,
            ],
        );
        DB::table('panditas')->insert(
            [
            'nama_pandita' => 'Lan TCS',
            'pandita_is_used' => false,
            ],
        );
        DB::table('panditas')->insert(
            [
            'nama_pandita' => 'Lin TCS',
            'pandita_is_used' => false,
            ],
        );
        DB::table('kotas')->insert(
            [
            'nama_kota' => 'Jakarta',
            'kota_is_used' => false,
            ],
        );
        DB::table('kotas')->insert(
            [
            'nama_kota' => 'Bandung',
            'kota_is_used' => false,
            ],
        );
        DB::table('kotas')->insert(
            [
            'nama_kota' => 'Medan',
            'kota_is_used' => false,
            ],
        );
        DB::table('kotas')->insert(
            [
            'nama_kota' => 'Surabaya',
            'kota_is_used' => false,
            ],
        );
        DB::table('kotas')->insert(
            [
            'nama_kota' => 'Batam',
            'kota_is_used' => false,
            ],
        );
        DB::table('branches')->insert(
            [
            'nama_branch' => 'BNI',
            'kode_branch' => 'BNI-01',
            'kota_id' => 1,
            'branch_is_used' => false,
            ],
        );
        

        
    }
}
