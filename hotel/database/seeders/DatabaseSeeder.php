<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Status;
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

        $allStatus = [
            "Pending",	
            "Booked",	
            "Checked-in",	
            "Checked-out",	
            "Cancelled",
            "Declined"
        ];

        foreach ($allStatus as $status) {
            Status::factory()->create(['status' => $status]);
        }

        
        User::factory()->create([
            'username' => 'admin',
            'email' => 'gusis@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 2,
        ]);
        
    }
}
