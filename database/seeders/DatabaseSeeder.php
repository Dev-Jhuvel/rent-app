<?php

namespace Database\Seeders;

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
        $password = '12345678';
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@email.com',
            'password' => bcrypt($password),
            'is_admin' => true,
            'members' => 0,
        ]);
        // User::factory()->create([
        //     'name' => 'User',
        //     'email' => 'user@email.com',
        //     'password' => bcrypt($password),
        //     'is_admin' => false,
        // ]);
    }
}
