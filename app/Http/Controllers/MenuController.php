<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function show($menu)
    {
        $menus = [
            // Non-Coffee Hot/Ice
            'Air Mineral' => [
                'name' => 'Air Mineral',
                'image' => 'photos/air-mineral.png',
                'description' => 'Air mineral segar.',
                'price' => ['hot' => 5000, 'ice' => 5000],
            ],
            'Avocado' => [
                'name' => 'Avocado',
                'image' => 'photos/avocado.png',
                'description' => 'Minuman alpukat yang creamy dan lezat.',
                'price' => ['hot' => 20000, 'ice' => 15000],
            ],
            'Choco' => [
                'name' => 'Choco',
                'image' => 'photos/choco.png',
                'description' => 'Cokelat hangat atau dingin yang manis.',
                'price' => ['hot' => 20000, 'ice' => 15000],
            ],
            'Matcha' => [
                'name' => 'Matcha',
                'image' => 'photos/matcha.png',
                'description' => 'Minuman matcha autentik dari Jepang.',
                'price' => ['hot' => 20000, 'ice' => 15000],
            ],
            'Red Velvet' => [
                'name' => 'Red Velvet',
                'image' => 'photos/red-velvet.png',
                'description' => 'Minuman red velvet dengan rasa khas.',
                'price' => ['hot' => 20000, 'ice' => 15000],
            ],
            'Taro' => [
                'name' => 'Taro',
                'image' => 'photos/taro.png',
                'description' => 'Minuman taro manis dengan aroma khas.',
                'price' => ['hot' => 20000, 'ice' => 15000],
            ],
            'Oreo Milkshake' => [
                'name' => 'Oreo Milkshake',
                'image' => 'photos/oreo-milkshake.png',
                'description' => 'Milkshake dengan campuran Oreo yang creamy.',
                'price' => ['hot' => 20000, 'ice' => 15000],
            ],
            'Lychee Yakult' => [
                'name' => 'Lychee Yakult',
                'image' => 'photos/lychee-yakult.png',
                'description' => 'Minuman Yakult rasa leci yang menyegarkan.',
                'price' => ['hot' => null, 'ice' => 18000],
            ],
            'Mango Yakult' => [
                'name' => 'Mango Yakult',
                'image' => 'photos/mango-yakult.png',
                'description' => 'Minuman Yakult rasa mangga yang lezat.',
                'price' => ['hot' => null, 'ice' => 20000],
            ],
            'Guava Yakult' => [
                'name' => 'Guava Yakult',
                'image' => 'photos/guava-yakult.png',
                'description' => 'Minuman Yakult rasa jambu biji yang unik.',
                'price' => ['hot' => null, 'ice' => 20000],
            ],
            'Jasmine Tea' => [
                'name' => 'Jasmine Tea',
                'image' => 'photos/jasmine-tea.png',
                'description' => 'Teh melati harum yang menenangkan.',
                'price' => ['hot' => 10000, 'ice' => 10000],
            ],
            'Lemon Tea' => [
                'name' => 'Lemon Tea',
                'image' => 'photos/lemon-tea.png',
                'description' => 'Teh lemon segar untuk menghilangkan dahaga.',
                'price' => ['hot' => null, 'ice' => 12000],
            ],
            'Lychee Tea' => [
                'name' => 'Lychee Tea',
                'image' => 'photos/lychee-tea.png',
                'description' => 'Teh leci manis yang menyegarkan.',
                'price' => ['hot' => null, 'ice' => 18000],
            ],

            // Espresso Based
            'Kopi Endowment' => [
                'name' => 'Kopi Endowment',
                'image' => 'photos/kopi-endowment.png',
                'description' => 'Kopi khas dengan cita rasa kuat.',
                'price' => 18000,
            ],
            'Americano' => [
                'name' => 'Americano',
                'image' => 'photos/americano.png',
                'description' => 'Kopi hitam klasik dengan rasa khas.',
                'price' => 15000,
            ],
            'Caffe Latte' => [
            'name' => 'Caffe Latte',
            'image' => 'photos/caffe-latte.png',
            'description' => 'Perpaduan sempurna antara kopi dan susu.',
            'price' => 18000,
            ],
            'Cappuccino' => [
                'name' => 'Cappuccino',
                'image' => 'photos/cappuccino.png',
                'description' => 'Kopi dengan lapisan foam susu yang lembut.',
                'price' => 18000,
            ],
            'Mochacino' => [
                'name' => 'Mochacino',
                'image' => 'photos/mochacino.png',
                'description' => 'Campuran kopi, cokelat, dan susu yang nikmat.',
                'price' => 20000,
            ],
            'Peppermint Latte' => [
                'name' => 'Peppermint Latte',
                'image' => 'photos/peppermint-latte.png',
                'description' => 'Kopi latte dengan sensasi segar peppermint.',
                'price' => 20000,
            ],
            'Caramel Latte' => [
                'name' => 'Caramel Latte',
                'image' => 'photos/caramel-latte.png',
                'description' => 'Latte manis dengan sirup karamel.',
                'price' => 23000,
            ],
            'Hazelnut Latte' => [
                'name' => 'Hazelnut Latte',
                'image' => 'photos/hazelnut-latte.png',
                'description' => 'Kopi latte dengan rasa khas hazelnut.',
                'price' => 23000,
            ],
            'Vanilla Latte' => [
                'name' => 'Vanilla Latte',
                'image' => 'photos/vanilla-latte.png',
                'description' => 'Latte dengan aroma dan rasa vanila.',
                'price' => 23000,
            ],
            'Redpresso' => [
                'name' => 'Redpresso',
                'image' => 'photos/redpresso.png',
                'description' => 'Espresso dengan rasa khas red velvet.',
                'price' => 20000,
            ],
            'Matcha Espresso' => [
                'name' => 'Matcha Espresso',
                'image' => 'photos/matcha-espresso.png',
                'description' => 'Kombinasi unik matcha dan espresso.',
                'price' => 20000,
            ],
            'Taro Coffee' => [
                'name' => 'Taro Coffee',
                'image' => 'photos/taro-coffee.png',
                'description' => 'Kopi dengan cita rasa taro yang manis.',
                'price' => 20000,
            ],
            'Avocado Coffee' => [
                'name' => 'Avocado Coffee',
                'image' => 'photos/avocado-coffee.png',
                'description' => 'Kopi dengan rasa alpukat yang kaya.',
                'price' => 20000,
            ],

            // Manual Brew
            'V60' => [
                'name' => 'V60',
                'image' => 'photos/v60.png',
                'description' => 'Metode seduh manual dengan filter V60, menghasilkan rasa kopi yang bersih dan kaya aroma.',
                'price' => 20000,
            ],
            'Japanese' => [
                'name' => 'Japanese',
                'image' => 'photos/japanese.png',
                'description' => 'Metode seduh ala Jepang dengan es, memberikan sensasi kopi yang dingin dan menyegarkan.',
                'price' => 20000,
            ],
            'Kopi Tubruk' => [
                'name' => 'Kopi Tubruk',
                'image' => 'photos/kopi-tubruk.png',
                'description' => 'Kopi klasik Indonesia dengan seduhan sederhana dan rasa yang autentik.',
                'price' => 15000,
            ],
            'Vietnam Drip' => [
                'name' => 'Vietnam Drip',
                'image' => 'photos/vietnam-drip.png',
                'description' => 'Kopi seduh gaya Vietnam dengan rasa yang kuat dan tekstur lembut.',
                'price' => 16000,
            ],

            // Bottle 1L
            'Kopi Endowment Bottle' => [
                'name' => 'Kopi Endowment Bottle',
                'image' => 'photos/kopi-endowment-bottle.png',
                'description' => 'Kopi Endowment dalam kemasan 1 liter, cocok untuk dinikmati bersama.',
                'price' => 70000,
            ],
            'Caramel Latte Bottle' => [
                'name' => 'Caramel Latte Bottle',
                'image' => 'photos/caramel-latte-bottle.png',
                'description' => 'Latte dengan sirup karamel dalam botol 1 liter.',
                'price' => 70000,
            ],
            'Hazelnut Latte Bottle' => [
                'name' => 'Hazelnut Latte Bottle',
                'image' => 'photos/hazelnut-latte-bottle.png',
                'description' => 'Kopi latte dengan rasa hazelnut dalam kemasan 1 liter.',
                'price' => 70000,
            ],
            'Vanilla Latte Bottle' => [
                'name' => 'Vanilla Latte Bottle',
                'image' => 'photos/vanilla-latte-bottle.png',
                'description' => 'Latte vanila dengan kemasan botol 1 liter.',
                'price' => 70000,
            ],
            'Avocado Bottle' => [
                'name' => 'Avocado Bottle',
                'image' => 'photos/avocado-bottle.png',
                'description' => 'Minuman alpukat creamy dalam botol 1 liter.',
                'price' => 70000,
            ],
            'Choco Bottle' => [
                'name' => 'Choco Bottle',
                'image' => 'photos/choco-bottle.png',
                'description' => 'Minuman cokelat manis dalam kemasan botol 1 liter.',
                'price' => 70000,
            ],
            'Matcha Bottle' => [
                'name' => 'Matcha Bottle',
                'image' => 'photos/matcha-bottle.png',
                'description' => 'Minuman matcha dalam kemasan botol 1 liter.',
                'price' => 70000,
            ],
            'Red Velvet Bottle' => [
                'name' => 'Red Velvet Bottle',
                'image' => 'photos/red-velvet-bottle.png',
                'description' => 'Minuman red velvet creamy dalam botol 1 liter.',
                'price' => 70000,
            ],
            'Taro Bottle' => [
                'name' => 'Taro Bottle',
                'image' => 'photos/taro-bottle.png',
                'description' => 'Minuman taro manis dalam kemasan botol 1 liter.',
                'price' => 70000,
            ],

            // Food
            'Cookies' => [
                'name' => 'Cookies',
                'image' => 'photos/cookies.png',
                'description' => 'Kue kering yang renyah dan manis, cocok untuk teman minum kopi.',
                'price' => 5000,
            ],
            'Roti Abon' => [
                'name' => 'Roti Abon',
                'image' => 'photos/roti-abon.png',
                'description' => 'Roti lembut dengan topping abon gurih.',
                'price' => 7000,
            ],
            'Roti Boy' => [
                'name' => 'Roti Boy',
                'image' => 'photos/roti-boy.png',
                'description' => 'Roti kopi khas dengan aroma yang harum.',
                'price' => 7000,
            ],
            'Roti Coklat' => [
                'name' => 'Roti Coklat',
                'image' => 'photos/roti-coklat.png',
                'description' => 'Roti isi coklat manis, sempurna untuk camilan.',
                'price' => 7000,
            ],
            'Roti Keju' => [
                'name' => 'Roti Keju',
                'image' => 'photos/roti-keju.png',
                'description' => 'Roti lembut dengan isi keju lezat.',
                'price' => 7000,
            ],
            'Popmie' => [
                'name' => 'Popmie',
                'image' => 'photos/popmie.png',
                'description' => 'Mi instan dalam kemasan cup, hangat dan praktis.',
                'price' => 10000,
            ],
            'Dimsum Ayam' => [
                'name' => 'Dimsum Ayam',
                'image' => 'photos/dimsum-ayam.png',
                'description' => 'Dimsum ayam lembut dengan saus khas.',
                'price' => 18000,
            ],
            'Dimsum Kepiting' => [
                'name' => 'Dimsum Kepiting',
                'image' => 'photos/dimsum-kepiting.png',
                'description' => 'Dimsum dengan rasa kepiting segar.',
                'price' => 18000,
            ],
            'Dimsum Keju' => [
                'name' => 'Dimsum Keju',
                'image' => 'photos/dimsum-keju.png',
                'description' => 'Dimsum lembut dengan isian keju gurih.',
                'price' => 18000,
            ],
            'Dimsum Nori' => [
                'name' => 'Dimsum Nori',
                'image' => 'photos/dimsum-nori.png',
                'description' => 'Dimsum dengan lapisan nori yang khas.',
                'price' => 18000,
            ],
            'Dimsum Hisitksu' => [
                'name' => 'Dimsum Hisitksu',
                'image' => 'photos/dimsum-hisitksu.png',
                'description' => 'Dimsum premium dengan rasa autentik.',
                'price' => 18000,
            ],
            'Nasi Ayam Kremes' => [
                'name' => 'Nasi Ayam Kremes',
                'image' => 'photos/nasi-ayam-kremes.png',
                'description' => 'Nasi hangat dengan ayam kremes renyah.',
                'price' => 20000,
            ],

        ];

        $menuDetails = $menus[$menu] ?? abort(404); // Jika menu tidak ditemukan

        return view('menu.show', compact('menuDetails'));
    }
}
