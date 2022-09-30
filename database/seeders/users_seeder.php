<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class users_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => "Admin",
                'email' => "Admin@spk.com",
                'password' => Hash::make('tjs123'),
                'is_admin' => "1",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => "Martini",
                'email' => "martini@spk.com",
                'password' => Hash::make('tjs123'),
                'is_admin' => "1",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => "Pengurus",
                'email' => "pengurus@spk.com",
                'password' => Hash::make('pengurus123'),
                'is_admin' => "0",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach($data as $item){
            DB::table('users')->insert($item);
        }
    }
}
