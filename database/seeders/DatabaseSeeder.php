<?php

namespace Database\Seeders;

use App\Models\Job;
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
            'first_name' => 'Mohammd',
            'last_name' => 'Hussein',
            'email' => 'mohammd.hussein04@gmail.com',
            'role' => 'employer'

        ]);
        $this->call(JobSeeder::class);
    }
}
