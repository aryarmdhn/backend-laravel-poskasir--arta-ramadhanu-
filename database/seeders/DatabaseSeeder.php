<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(15)->create();

        \App\Models\User::factory()->create([
            'name' => 'Arya aja',
            'email' => 'arya@example.com',
            'role' => 'admin',
            'password' => Hash::make('12345678')
        ]);
        \App\Models\User::factory()->create([
            'name' => 'staff jo',
            'email' => 'staff@example.com',
            'role' => 'staff',
            'password' => Hash::make('12345678')
        ]);

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class
        ]);
    }
}
