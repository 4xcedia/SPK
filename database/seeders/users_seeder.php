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
        DB::table('users')->insert([
            'name' => "Admin",
            'email' => "Admin@spk.com",
            'password' => Hash::make('tjs123'),
            'is_admin' => "1",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
