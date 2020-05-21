<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name'      =>   'Brayan Vilchez Daga',
            'username'  =>    'BrayanDaga',
            'email'     =>   'bm_vd_1605@hotmail.com',
            'password'  =>   Hash::make('brayanvilchez'),
            'apitoken'  =>    Str::random(60)
        ]);
    }
}
