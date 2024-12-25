<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product; // Add this import to use the Product model
use Database\Seeders\ProductSeeder; // Import ProductSeeder

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Insert multiple users into the users table
        DB::table('users')->insert([
            [
                'name' => 'Putri Fawwaz',
                'email' => 'pputrinf@gmail.com',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'kay',
                'email' => 'admin@mail.com',
                'password' => bcrypt('admin'),
            ]
        ]);

        // Call ProductSeeder to seed the products
        $this->call(ProductSeeder::class);
    }
}
