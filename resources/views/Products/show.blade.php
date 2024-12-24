<x-app-layout>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ $product->name }}
    </h2>

    <div class="container mx-auto mt-6">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-60 object-cover mb-4 rounded">
            <h3 class="text-2xl font-bold">{{ $product->name }}</h3>
            <p class="mt-2">{{ $product->description }}</p>

            <form method="POST" action="{{ route('cart.add') }}" id="addToCartForm">
                @csrf
                <div class="mt-4">
                    <label for="temperature" class="font-semibold">Choose Temperature:</label>
                    <select name="temperature" id="temperature" class="border-gray-300 rounded shadow">
                        <option value="hot">Hot - Rp{{ $product->hot_price }}</option>
                        <option value="ice">Ice - Rp{{ $product->ice_price }}</option>
                    </select>
                </div>

                <div class="mt-4">
                    <label for="quantity" class="font-semibold">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1"
                           class="border-gray-300 rounded shadow w-16">
                </div>

                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <button type="submit" id="addToCartButton" class="mt-4 bg-blue-500 text-white font-semibold py-2 px-4 rounded">
                    Add to Cart
                </button>
            </form>
        </div>
    </div>

    <!-- Pop-Up Modal -->
    <div id="cartPopup" class="fixed inset-0 bg-gray-800 bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h3 class="text-xl font-bold" id="popupProductName"></h3>
            <p id="popupPrice" class="mt-2 text-lg"></p>
            <div class="mt-4 flex items-center">
                <button id="decreaseQuantity" class="bg-gray-300 px-2 py-1 rounded">-</button>
                <input type="number" id="popupQuantity" value="1" min="1" class="mx-2 border-gray-300 rounded w-16 text-center">
                <button id="increaseQuantity" class="bg-gray-300 px-2 py-1 rounded">+</button>
            </div>
            <div class="mt-4 flex justify-between">
                <button id="viewCartButton" class="bg-blue-500 text-white py-2 px-4 rounded">View Cart</button>
                <button id="closePopupButton" class="bg-red-500 text-white py-2 px-4 rounded">Close</button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('addToCartForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const productName = '{{ $product->name }}';
            const hotPrice = '{{ $product->hot_price }}';
            const icePrice = '{{ $product->ice_price }}';
            const quantity = document.getElementById('quantity').value;
            const temperature = document.getElementById('temperature').value;

            const price = temperature === 'hot' ? hotPrice : icePrice;
            const totalPrice = price * quantity;

            document.getElementById('popupProductName').textContent = productName;
            document.getElementById('popupPrice').textContent = `Price: Rp${totalPrice}`;
            document.getElementById('popupQuantity').value = quantity;

            document.getElementById('cartPopup').classList.remove('hidden');
        });

        document.getElementById('closePopupButton').addEventListener('click', function() {
            document.getElementById('cartPopup').classList.add('hidden');
        });

        document.getElementById('viewCartButton').addEventListener('click', function() {
            window.location.href = '{{ route('cart.index') }}';
        });

        document.getElementById('increaseQuantity').addEventListener('click', function() {
            let quantity = parseInt(document.getElementById('popupQuantity').value);
            document.getElementById('popupQuantity').value = quantity + 1;
            updatePrice();
        });

        document.getElementById('decreaseQuantity').addEventListener('click', function() {
            let quantity = parseInt(document.getElementById('popupQuantity').value);
            if (quantity > 1) {
                document.getElementById('popupQuantity').value = quantity - 1;
                updatePrice();
            }
        });

        function updatePrice() {
            const quantity = document.getElementById('popupQuantity').value;
            const temperature = document.getElementById('temperature').value;
            const price = temperature === 'hot' ? '{{ $product->hot_price }}' : '{{ $product->ice_price }}';
            const totalPrice = price * quantity;
            document.getElementById('popupPrice').textContent = `Price: Rp${totalPrice}`;
        }
    </script>
</x-app-layout>
