<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        for ($i = 1; $i <= 5; $i++) {
            User::factory()->create([
                "name" => "admin" . $i,
                "email" => "admin" . $i . "@ppdb.com",
                "password" => bcrypt("password")
            ]);
        }
    }
}