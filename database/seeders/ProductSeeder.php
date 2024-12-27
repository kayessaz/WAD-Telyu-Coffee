<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Define the menu data
        $menus = [
            'non_coffee' => [
                ['name' => 'Air Mineral', 'description' => 'Minuman sehat yang menyegarkan.', 'image_url' => 'photos/ambience-2.png'],
                ['name' => 'Avocado', 'description' => 'Smoothie alpukat dengan cita rasa manis.', 'image_url' => 'photos/ambience-2.png'],
                ['name' => 'Choco', 'description' => 'Minuman coklat yang kaya rasa.', 'image_url' => 'photos/ambience-2.png'],
                ['name' => 'Matcha', 'description' => 'Teh hijau premium dengan rasa khas.', 'image_url' => 'photos/ambience-2.png'],
                ['name' => 'Red Velvet', 'description' => 'Minuman dengan rasa manis khas red velvet.', 'image_url' => 'photos/ambience-2.png'],
                ['name' => 'Taro', 'description' => 'Minuman taro creamy yang lembut.', 'image_url' => 'photos/ambience-2.png'],
                ['name' => 'Oreo Milkshake', 'description' => 'Milkshake dengan campuran biskuit Oreo.', 'image_url' => 'photos/ambience-2.png'],
                ['name' => 'Lychee Yakult', 'description' => 'Minuman menyegarkan dengan rasa leci.', 'image_url' => 'photos/ambience-2.png'],
                ['name' => 'Jasmine Tea', 'description' => 'Teh melati dengan aroma yang harum.', 'image_url' => 'photos/ambience-2.png'],
            ],
            'espresso_based' => [
                ['name' => 'Kopi Endowment', 'description' => 'Espresso khas dengan cita rasa istimewa.', 'image_url' => 'photos/ambience-2.png'],
                ['name' => 'Americano', 'description' => 'Espresso dengan tambahan air untuk rasa ringan.', 'image_url' => 'photos/ambience-2.png'],
                ['name' => 'Caffe Latte', 'description' => 'Espresso dengan campuran susu yang creamy.', 'image_url' => 'photos/ambience-2.png'],
                ['name' => 'Cappuccino', 'description' => 'Espresso dengan busa susu yang lembut.', 'image_url' => 'photos/ambience-2.png'],
                ['name' => 'Caramel Latte', 'description' => 'Kopi susu dengan rasa karamel yang manis.', 'image_url' => 'photos/ambience-2.png'],
            ],
            'manual_brew' => [
                ['name' => 'V60', 'description' => 'Manual brew dengan metode V60.', 'image_url' => 'photos/ambience-2.png'],
                ['name' => 'Japanese', 'description' => 'Manual brew dengan teknik khas Jepang.', 'image_url' => 'photos/ambience-2.png'],
                ['name' => 'Vietnam Drip', 'description' => 'Manual brew dengan gaya Vietnam.', 'image_url' => 'photos/ambience-2.png'],
            ],
            'bottle_1L' => [
                ['name' => 'Kopi Endowment 1L', 'description' => 'Espresso khas dalam kemasan 1 liter.', 'image_url' => 'photos/ambience-2.png'],
                ['name' => 'Caramel Latte 1L', 'description' => 'Kopi susu karamel dalam kemasan 1 liter.', 'image_url' => 'photos/ambience-2.png'],
                ['name' => 'Matcha 1L', 'description' => 'Teh hijau premium dalam kemasan 1 liter.', 'image_url' => 'photos/ambience-2.png'],
            ],
            'food' => [
                ['name' => 'Cookies', 'description' => 'Cookies renyah dengan rasa manis.', 'image_url' => 'photos/ambience-2.png'],
                ['name' => 'Roti Abon', 'description' => 'Roti lembut dengan taburan abon.', 'image_url' => 'photos/ambience-2.png'],
                ['name' => 'Dimsum Ayam', 'description' => 'Dimsum ayam kukus dengan saus khas.', 'image_url' => 'photos/ambience-2.png'],
                ['name' => 'Nasi Ayam Kremes', 'description' => 'Nasi dengan ayam kremes yang gurih.', 'image_url' => 'photos/ambience-2.png'],
            ],
        ];

        // Insert products for each category
        foreach ($menus as $category => $products) {
            foreach ($products as $product) {
                Product::create([
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'category' => $category,
                    'image_url' => '/storage/products/AKjNxAuP1R.jpg',
                    'hot_price' => rand(10000, 50000), // Add a random price as an example
                    'ice_price' => rand(10000, 50000), // Add a random price as an example
                ]);
            }
        }
    }
}
