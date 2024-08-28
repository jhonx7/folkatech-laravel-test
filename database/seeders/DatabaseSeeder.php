<?php

namespace Database\Seeders;

use App\Models\Companies;
use App\Models\Employees;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@folkatech.com',
        ]);

        Companies::factory(30)->create();
        Employees::factory(300)->create();

    }
}
