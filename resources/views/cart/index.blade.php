<x-app-layout>
    <div class="bg-white min-h-screen pb-10">
        <h1 class="text-3xl font-bold mb-5">Your Cart</h1>
        @if (session('success'))
            <div class="bg-red-600 text-white p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($cartItems->isEmpty())
            <p class="text-gray-600">Your cart is empty.</p>
        @else
            <ul>
                @foreach ($cartItems as $cartItem)
                    <li class="mb-6 flex items-start justify-between">
                        <!-- Item Menu -->
                        <div class="border rounded-lg p-4 shadow-md flex-grow">
                            <div class="flex items-start">
                                <div class="mr-4 relative">
                                    <img src="{{ asset($cartItem->product->image_url) }}" class="w-24 h-24 object-cover rounded-md" alt="{{ $cartItem->product->name }}">
                                </div>
                                <div class="flex-grow ml-5">
                                    <div class="flex justify-between">
                                        <h3 class="text-lg font-semibold">
                                            {{ $cartItem->product->name }}
                                            @if(in_array($cartItem->product->category, ['Espresso Based', 'Manual Brew', 'Non-Coffee']))
                                                ({{ ucfirst($cartItem->temperature) }})
                                            @endif
                                        </h3>
                                        <div class="flex items-center">
                                            <p class="font-semibold text-red-600 bg-white border-2 border-red-600 rounded-full py-1 px-4 text-sm">
                                                {{ $cartItem->product->category }}
                                            </p>
                                            <!-- Remove Button -->
                                            <form action="{{ route('cart.remove', ['id' => $cartItem->id]) }}" method="post" class="ml-4">
                                                @csrf
                                                <button type="submit" class="p-2 border border-red-600 text-red-600 hover:bg-red-600 hover:text-white rounded-full">
                                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <p class="text-gray-600 font-semibold">Rp.
                                        @if($cartItem->temperature === 'general')
                                            {{ $cartItem->product->price }}
                                        @else
                                            {{ $cartItem->temperature === 'hot' ? $cartItem->product->hot_price : $cartItem->product->ice_price }}
                                        @endif
                                    </p>
                                    <div class="flex items-center mt-2">
                                        <button type="button" class="bg-white hover:bg-red-500 text-red-700 border border-red-700 hover:text-white font-semibold py-0 px-1 rounded transition-colors" onclick="updateQuantity({{ $cartItem->id }}, 'decrease')">-</button>
                                        <span id="quantity-{{ $cartItem->id }}" class="mx-2 text-gray-800 font-semibold">{{ $cartItem->quantity }}</span>
                                        <button type="button" class="bg-white hover:bg-red-500 text-red-700 border border-red-700 hover:text-white font-semibold py-0 px-1 rounded transition-colors" onclick="updateQuantity({{ $cartItem->id }}, 'increase')">+</button>
                                        <p class="ml-auto text-red-700 font-semibold">Subtotal:</p>
                                        <p class="ml-2 text-gray-800 font-semibold">Rp.
                                            @if($cartItem->temperature === 'general')
                                                {{ $cartItem->product->price * $cartItem->quantity }}
                                            @else
                                                {{ ($cartItem->temperature === 'hot' ? $cartItem->product->hot_price : $cartItem->product->ice_price) * $cartItem->quantity }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="mt-6 flex justify-between items-center">
                <h3 class="text-lg font-bold text-red-900">Total Price: Rp. {{ $totalPrice }}</h3>
                <a href="{{ route('checkout.index') }}" class="bg-red-700 text-white px-4 py-2 rounded-md hover:scale-105 transition-transform">
                    Checkout
                </a>
            </div>
        @endif
    </div>

    <script>
        function updateQuantity(cartItemId, action) {
            const quantityElement = document.getElementById(`quantity-${cartItemId}`);
            let quantity = parseInt(quantityElement.textContent);

            if (action === 'decrease' && quantity > 1) {
                quantity--;
            } else if (action === 'increase') {
                quantity++;
            }

            quantityElement.textContent = quantity;

            // Mengambil harga sesuai dengan kondisi
            const priceElement = document.getElementById(`price-${cartItemId}`);
            const price = parseFloat(priceElement.dataset.price); // Ambil data harga

            // Hitung subtotal baru
            const subtotal = price * quantity;
            const subtotalElement = document.getElementById(`subtotal-${cartItemId}`);
            subtotalElement.textContent = `Rp. ${subtotal.toFixed(2)}`;

            // Kirimkan data ke server untuk pembaruan kuantitas dan subtotal
            fetch(`/cart/update/${cartItemId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ quantity, subtotal })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Failed to update quantity.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to update quantity.');
            });
        }

    </script>
</x-app-layout>
