<?php

namespace Modules\Auth\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\app\Models\User;

class AuthDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /// create super admin user
        User::create([
            'name' => 'Super Admin',
            'email' => "super@admin.com",
            'phone' => "+201099647084",
            'password' => Hash::make("Super@#Admin"),
            'is_admin' => true
        ]);

        /// seed 10 random users
        User::factory(10)->create();
    }
}
