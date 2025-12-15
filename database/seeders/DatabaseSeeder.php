<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Destination;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'vashzaccheus@gmail.com',
            'password' => Hash::make('321321321'),
            'email_verified_at' => now(),
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Demo User',
            'email' => 'fidzaccheus@gmail.com.com',
            'password' => Hash::make('321321321'),
            'email_verified_at' => now(),
            'is_admin' => false,
        ]);

        $demoUser = User::where('email', 'fidzaccheus@gmail.com')->first();

        Destination::create([
            'user_id' => $demoUser->id,
            'destination_name' => 'Eiffel Tower',
            'country' => 'France',
            'city' => 'Paris',
            'description' => 'Iconic iron lattice tower on the Champ de Mars',
            'status' => 'Noted',
            'tag' => 'City',
            'budget' => 150000,
        ]);

        Destination::create([
            'user_id' => $demoUser->id,
            'destination_name' => 'Boracay Beach',
            'country' => 'Philippines',
            'city' => 'Malay',
            'description' => 'Famous white sand beach resort',
            'status' => 'Completed',
            'tag' => 'Beach',
            'budget' => 50000,
        ]);
    }
}