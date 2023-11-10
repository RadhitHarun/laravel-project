<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {       
            $user = User::create([
                'name'          => 'radhit',
                'email'         => 'radhit@admin.com',
                'password'      =>  Hash::make('123'),
                'role_id'       => 1
            ]);
            $user = User::create([
                'first_name'    => 'budiman',
                'email'         =>  'budiman@mch.com',
                'password'      =>  Hash::make('123'),
                'role_id'       => 3
            ]);
    }
}
