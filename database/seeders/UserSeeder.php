<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     "name"=> "Eslam Badawy",
        //     "email"=> "e@badawy.eb",
        //     "password"=> Hash::make("password"),
        //     "phone_number"=> "01150099801",
        // ]);
        // DB::table("users")->insert([
        //     "name"=> "Raghda",
        //     "email"=> "r@badawy.eb",
        //     "password"=> Hash::make("password"),
        //     "phone_number"=> "00084387467",
        // ]);
    }
}
