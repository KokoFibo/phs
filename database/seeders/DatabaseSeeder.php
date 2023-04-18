<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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


        DB::table('users')->insert(
            [
                'name' => 'Anton Manager',
                'email' => 'anton3@anton.com',
                'password' => Hash::make('Anton888'),
                'role' => 3,
                'kota_id' => 1 ,
                'branch_id' => 1,
                'groupvihara_id' => 1,
                'pandita_id' => 1,

            ],
        );
        DB::table('users')->insert(
            [
                'name' => 'Anton Supervisor',
                'email' => 'anton2@anton.com',
                'password' => Hash::make('Anton888'),
                'role' => 3,
                'kota_id' => 1 ,
                'branch_id' => 1,
                'groupvihara_id' => 1,
                'pandita_id' => 1,
            ],
        );
        DB::table('users')->insert(
            [
                'name' => 'Anton Admin',
                'email' => 'anton1@anton.com',
                'password' => Hash::make('Anton888'),
                'role' => 3,
                'kota_id' => 1 ,
                'branch_id' => 1,
                'groupvihara_id' => 1,
                'pandita_id' => 1,

            ],
        );
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
            'nama_branch' => '立達壇',
            'groupvihara_id' => 1,
            'branch_is_used' => true,
            ],
        );
        DB::table('branches')->insert(


            [
            'nama_branch' => '立德壇',
            'groupvihara_id' => 2,
            'branch_is_used' => true,
            ],
        );

        DB::table('branches')->insert(
            [
            'nama_branch' => 'Dadap',
            'groupvihara_id' => 3,
            'branch_is_used' => true,
            ],
        );
        DB::table('groupviharas')->insert(
            [
            'nama_group' => 'Group Lik Ta',
            'group_is_used' => false,
            ],
        );
        DB::table('groupviharas')->insert(
            [
            'nama_group' => 'Group Taman Surya',
            'group_is_used' => false,
            ],
        );
        DB::table('groupviharas')->insert(
            [
            'nama_group' => 'Group Dadap',
            'group_is_used' => false,
            ],
        );

        // DB::table('users')->insert(
        //     [
        //     'name' => 'Anton Admin',
        //     'email' => 'anton1@anton.com',
        //     'password' => Hash::make('Anton888'),
        //     'role' => '1',
        //     'kota_id' => 1,
        //     'branch_id' => 1,
        //     ],
        // );


    }
}
