<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administratorCount = 2;
        $unitadminCount = 10;
        $borrowerCount = 20;

        User::factory()->count($administratorCount)->create(['role' => 'administrator']);
        User::factory()->count($unitadminCount)->create(['role' => 'unitadmin']);
        User::factory()->count($borrowerCount)->create(['role' => 'borrower']);
    }
}
