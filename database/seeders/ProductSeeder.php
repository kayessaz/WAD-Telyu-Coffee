<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            ['name' => 'Air Mineral', 'price' => 5000, 'category' => 'Non-Coffee'],
            ['name' => 'Americano', 'price' => 15000, 'category' => 'Espresso-Based'],
            ['name' => 'V60', 'price' => 20000, 'category' => 'Manual Brew'],
            ['name' => 'Kopi Endowment 1L', 'price' => 70000, 'category' => 'Bottle 1L'],
            ['name' => 'Cookies', 'price' => 5000, 'category' => 'Food'],
        ]);
    }
}
