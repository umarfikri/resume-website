<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Document;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {        

        // Create 10 fake users
        // \App\Models\User::factory(10)->create();

        // Create 1 admin user
        User::create([
            'username' => 'admin',
            'password' => bcrypt('1234'),
            'userLevel' => 'admin'
        ]);

        // Create 1 editor user
        User::create([
            'username' => 'editor',
            'password' => bcrypt('1234'),
            'userLevel' => 'editor'
        ]);

        // Create 1 viewer user
        User::create([
            'username' => 'viewer',
            'password' => bcrypt('1234'),
            'userLevel' => 'viewer'
        ]);

        $this->call([
            DocumentSeeder::class,
        ]);
    }
}
