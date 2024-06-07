<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\status;
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

        $status = [
            "Pending",	
            "Booked",	
            "Checked-in",	
            "Checked-out",	
            "Cancelled",
            "Declined"
        ];

        foreach ($cities as $city) {
            Location::factory()->create(['location' => $city]);
        }
    }
}
