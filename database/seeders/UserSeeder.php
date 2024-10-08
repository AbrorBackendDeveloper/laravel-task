<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name"=> "Manager",
            "role_id" => 1,
            "email"=> "manager@gmail.com",
            "password"=> bcrypt("manager"),
        ]);
        
        User::create([
            "name"=> "Abror",
            "role_id" => 2,
            "email"=> "abror@gmail.com",
            "password"=> bcrypt("abror"),
        ]);
    }
}
