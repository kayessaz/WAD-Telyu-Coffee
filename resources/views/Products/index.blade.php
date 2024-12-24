<x-app-layout>
        <div class="container">
            <!-- FILTER MENU -->
            <div class="mb-6">
                <form method="GET" action="{{ route('menu.index') }}">
                    <label for="filter" class="font-semibold mr-2">Filter Kategori:</label>
                    <select name="filter" id="filter" onchange="this.form.submit()" class="border-gray-300 rounded shadow">
                        <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>All</option>
                        <option value="non_coffee" {{ request('filter') == 'non_coffee' ? 'selected' : '' }}>Non-Coffee</option>
                        <option value="espresso_based" {{ request('filter') == 'espresso_based' ? 'selected' : '' }}>Espresso Based</option>
                        <option value="manual_brew" {{ request('filter') == 'manual_brew' ? 'selected' : '' }}>Manual Brew</option>
                        <option value="bottle_1L" {{ request('filter') == 'bottle_1L' ? 'selected' : '' }}>Bottle 1L</option>
                        <option value="food" {{ request('filter') == 'food' ? 'selected' : '' }}>Food</option>
                    </select>
                </form>
            </div>

            <a href="{{ route('cart.index') }}" id="caty-toggle" class="fixed bottom-4 right-4 hover:bg-blue-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                View Cart
            </a>
        </div>

        <!-- MENU LIST -->
        <div class="container">
            @php
                $menus = [
                    'non_coffee' => [
                        ['id' => 1, 'name' => 'Air Mineral', 'description' => 'Minuman sehat yang menyegarkan.', 'image' => 'photos/ambience-2.png'],
                        ['id' => 2, 'name' => 'Avocado', 'description' => 'Smoothie alpukat dengan cita rasa manis.', 'image' => 'photos/ambience-2.png'],
                        ['id' => 3, 'name' => 'Choco', 'description' => 'Minuman coklat yang kaya rasa.', 'image' => 'photos/ambience-2.png'],
                        ['id' => 4, 'name' => 'Matcha', 'description' => 'Teh hijau premium dengan rasa khas.', 'image' => 'photos/ambience-2.png'],
                        ['id' => 5, 'name' => 'Red Velvet', 'description' => 'Minuman dengan rasa manis khas red velvet.', 'image' => 'photos/ambience-2.png'],
                        ['id' => 6, 'name' => 'Taro', 'description' => 'Minuman taro creamy yang lembut.', 'image' => 'photos/ambience-2.png'],
                        ['id' => 7, 'name' => 'Oreo Milkshake', 'description' => 'Milkshake dengan campuran biskuit Oreo.', 'image' => 'photos/ambience-2.png'],
                        ['id' => 8, 'name' => 'Lychee Yakult', 'description' => 'Minuman menyegarkan dengan rasa leci.', 'image' => 'photos/ambience-2.png'],
                        ['id' => 9, 'name' => 'Jasmine Tea', 'description' => 'Teh melati dengan aroma yang harum.', 'image' => 'photos/ambience-2.png'],
                    ],
                    'espresso_based' => [
                        ['id' => 10, 'name' => 'Kopi Endowment', 'description' => 'Espresso khas dengan cita rasa istimewa.', 'image' => 'photos/ambience-2.png'],
                        ['id' => 11, 'name' => 'Americano', 'description' => 'Espresso dengan tambahan air untuk rasa ringan.', 'image' => 'photos/ambience-2.png'],
                        ['id' => 12, 'name' => 'Caffe Latte', 'description' => 'Espresso dengan campuran susu yang creamy.', 'image' => 'photos/ambience-2.png'],
                        ['id' => 13, 'name' => 'Cappuccino', 'description' => 'Espresso dengan busa susu yang lembut.', 'image' => 'photos/ambience-2.png'],
                        ['id' => 14, 'name' => 'Caramel Latte', 'description' => 'Kopi susu dengan rasa karamel yang manis.', 'image' => 'photos/ambience-2.png'],
                    ],
                    'manual_brew' => [
                        ['id' => 15, 'name' => 'V60', 'description' => 'Manual brew dengan metode V60.', 'image' => 'photos/ambience-2.png'],
                        ['id' => 16, 'name' => 'Japanese', 'description' => 'Manual brew dengan teknik khas Jepang.', 'image' => 'photos/ambience-2.png'],
                        ['id' => 17, 'name' => 'Vietnam Drip', 'description' => 'Manual brew dengan gaya Vietnam.', 'image' => 'photos/ambience-2.png'],
                    ],
                    'bottle_1L' => [
                        ['id' => 18, 'name' => 'Kopi Endowment 1L', 'description' => 'Espresso khas dalam kemasan 1 liter.', 'image' => 'photos/ambience-2.png'],
                        ['id' => 19, 'name' => 'Caramel Latte 1L', 'description' => 'Kopi susu karamel dalam kemasan 1 liter.', 'image' => 'photos/ambience-2.png'],
                        ['id' => 20, 'name' => 'Matcha 1L', 'description' => 'Teh hijau premium dalam kemasan 1 liter.', 'image' => 'photos/ambience-2.png'],
                    ],
                    'food' => [
                        ['id' => 21, 'name' => 'Cookies', 'description' => 'Cookies renyah dengan rasa manis.', 'image' => 'photos/ambience-2.png'],
                        ['id' => 22, 'name' => 'Roti Abon', 'description' => 'Roti lembut dengan taburan abon.', 'image' => 'photos/ambience-2.png'],
                        ['id' => 23, 'name' => 'Dimsum Ayam', 'description' => 'Dimsum ayam kukus dengan saus khas.', 'image' => 'photos/ambience-2.png'],
                        ['id' => 24, 'name' => 'Nasi Ayam Kremes', 'description' => 'Nasi dengan ayam kremes yang gurih.', 'image' => 'photos/ambience-2.png'],
                    ],
                ];

                $filter = request('filter', 'all');
            @endphp

            @foreach($menus as $category => $items)
            @if($filter == 'all' || $filter == $category)
                <h3 class="text-2xl font-bold mt-5">{{ ucfirst(str_replace('_', ' ', $category)) }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-4">
                    @foreach($items as $item)
                        <div class="bg-white p-4 rounded-lg shadow-lg text-left">
                            <a href="{{ route('Products.show', ['id' => $item['id']]) }}">
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-40 object-cover mb-4 rounded">
                                <h5 class="text-xl font-semibold text-left">{{ $item['name'] }}</h5>
                                <p class="text-sm text-gray-500 mt-2 text-left">{{ $item['description'] }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
</x-app-layout>
