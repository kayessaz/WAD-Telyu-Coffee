<x-app-layout>
    <div class="bg-white min-h-screen flex justify-center items-center pb-20">
        <div class="bg-white p-6 rounded-lg flex flex-col md:flex-row w-full max-w-7xl">
            <div class="flex flex-col w-full md:w-1/2">
                <img id="mainImage" src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-[500px] rounded-xl shadow-xl object-cover mb-4" />
                {{-- <div class="flex justify-between gap-2">
                    <img src="{{ $product->image_url }}" alt="Thumbnail 1" class="w-1/4 h-20 object-cover rounded-lg cursor-pointer" onclick="changeImage('{{ $product->image_url }}')">
                    <img src="{{ $product->image_url }}" alt="Thumbnail 2" class="w-1/4 h-20 object-cover rounded-lg cursor-pointer" onclick="changeImage('{{ $product->image_url }}')">
                    <img src="{{ $product->image_url }}" alt="Thumbnail 3" class="w-1/4 h-20 object-cover rounded-lg cursor-pointer" onclick="changeImage('{{ $product->image_url }}')">
                    <img src="{{ $product->image_url }}" alt="Thumbnail 4" class="w-1/4 h-20 object-cover rounded-lg cursor-pointer" onclick="changeImage('{{ $product->image_url }}')">
                </div> --}}
            </div>
            <div class="w-full md:w-1/2 bg-white text-red-700 rounded-lg p-6 ml-0 md:ml-8">
                <p class="mt-2 font-semibold text-red-500 mb-3">{{ $product->category }}</p>
                <h3 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h3>
                <p class="mt-2 font-semibold">Description:</p>
                <p class="mt-2 text-lg leading-8 text-gray-600 mb-5">{{ $product->description }}</p>

                @if($product->category == 'Food' || $product->category == 'Bottle 1L')
                <p class="mt-5 font-semibold">Quantity</p>
                <div class="flex items-center justify-between mt-5">
                    <div class="flex items-center">
                        <button class="ml-2 border border-red-500 text-red-500  hover:bg-red-600 hover:text-white font-semibold py-0 px-1 rounded" id="decrease">-</button>
                        <span id="quantity" class="mx-2 text-gray-800 font-semibold">1</span>
                        <button class="border border-red-500 text-red-500  hover:bg-red-600 hover:text-white font-semibold py-0 px-1 rounded" id="increase">+</button>
                    </div>
                    <div>
                        <span class="text-red-700 font-semibold">Price:</span>
                        <span id="priceDisplay" class="ml-2 text-gray-800 font-semibold">Rp0</span>
                    </div>
                </div>
                <input type="hidden" name="temperature" value="general" id="temperature">
                @else
                <p class="mt-2 font-semibold">Variants</p>
                <div class="mt-4 flex flex-col items-start gap-4">
                    <div class="flex w-full gap-4 justify-start">
                        <!-- Ice Button -->
                        <div
                            class="w-24 bg-white text-red-700 border border-red-700 rounded-full shadow-md p-2 text-center cursor-pointer hover:text-white hover:bg-red-800 transform hover:scale-105 transition"
                            id="temperatureIce"
                            data-temperature="ice"
                            onclick="selectTemperature('ice')">
                            Ice
                        </div>
                        <!-- Hot Button -->
                        <div
                            class="w-24 bg-white text-red-700 border border-red-700 rounded-full shadow-md p-2 text-center cursor-pointer hover:text-white hover:bg-red-800 transform hover:scale-105 transition"
                            id="temperatureHot"
                            data-temperature="hot"
                            onclick="selectTemperature('hot')">
                            Hot
                        </div>
                    </div>
                </div>
                <p class="mt-5 font-semibold">Quantity</p>
                <div class="flex items-center justify-between mt-5">
                    <div class="flex items-center">
                        <button class="ml-2 bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-2 rounded" id="decrease">-</button>
                        <span id="quantity" class="mx-2 text-gray-800 font-semibold">1</span>
                        <button class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-2 rounded" id="increase">+</button>
                    </div>
                    <div>
                        <span class="text-red-700 font-semibold">Price:</span>
                        <span id="priceDisplay" class="ml-2 text-gray-800 font-semibold">Rp0</span>
                    </div>
                </div>
                @endif

                <!-- Add to Cart and Checkout Buttons -->
                <form method="POST" action="{{ route('cart.add') }}" id="addToCartForm" class="mt-4 flex gap-4 bottom-0 left-0 right-0">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1" id="productQuantity">
                    <input type="hidden" name="temperature" value="ice" id="productTemperature">
                    <button type="submit" id="addToCartButton" class="w-full bg-white text-red-500 border border-red-500 font-semibold py-2 rounded shadow-md hover:bg-red-500 hover:text-white transform hover:scale-105 transition">
                        Add to Cart
                    </button>
                    <a href="{{ route('checkout.index') }}" class="w-full text-center bg-red-500 text-white font-semibold py-2 rounded shadow-md hover:bg-red-600 transform hover:scale-105 transition">
                        Checkout
                    </a>
                </form>
            </div>

        <!-- Sticky Cart Card at Bottom -->
        <div id="cartCard" class="fixed bottom-0 inset-x-0 bg-red-700 text-white border-t shadow-lg p-4 hidden z-50">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-lg font-bold" id="cardTotalPrice">Price: Rp0</p>
                    <p class="text-sm" id="cardQuantity">Quantity: 0</p>
                </div>
                <button id="viewCartButton" class="bg-white text-red-700 py-2 px-4 rounded hover:bg-red-900 hover:text-white transform hover:scale-105 transition">View Cart</button>
            </div>
        </div>
    </div>

    <script>
        function changeImage(src) {
            document.getElementById('mainImage').src = src;
        }

        document.getElementById('addToCartForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            const quantity = document.getElementById('productQuantity').value;
            const temperature = formData.get('temperature');
            const price = calculatePrice('{{ $product->category }}', temperature);
            const totalPrice = price * quantity;

            updateCard(totalPrice, quantity);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('cartCard').classList.remove('hidden');
                } else {
                    alert('Failed to add product to cart.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to add product to cart.');
            });
        });

        document.getElementById('viewCartButton').addEventListener('click', function() {
            window.location.href = '{{ route('cart.index') }}';
        });

        document.getElementById('decrease').addEventListener('click', function() {
            let quantity = parseInt(document.getElementById('productQuantity').value);
            if (quantity > 1) {
                quantity--;
                document.getElementById('productQuantity').value = quantity;
                document.getElementById('quantity').textContent = quantity;
                updatePrice();
            }
        });

        document.getElementById('increase').addEventListener('click', function() {
            let quantity = parseInt(document.getElementById('productQuantity').value);
            quantity++;
            document.getElementById('productQuantity').value = quantity;
            document.getElementById('quantity').textContent = quantity;
            updatePrice();
        });

        function selectTemperature(temperature) {
            document.getElementById('productTemperature').value = temperature;
            updatePrice();
            updateButtonStyles(temperature);
        }

        function updateButtonStyles(selectedTemperature) {
            const iceButton = document.getElementById('temperatureIce');
            const hotButton = document.getElementById('temperatureHot');

            if (selectedTemperature === 'ice') {
                iceButton.classList.add('bg-red-800', 'text-white');
                iceButton.classList.remove('bg-white', 'text-red-700');
                hotButton.classList.add('bg-white', 'text-red-700');
                hotButton.classList.remove('bg-red-800', 'text-white');
            } else {
                hotButton.classList.add('bg-red-800', 'text-white');
                hotButton.classList.remove('bg-white', 'text-red-700');
                iceButton.classList.add('bg-white', 'text-red-700');
                iceButton.classList.remove('bg-red-800', 'text-white');
            }
        }

        function calculatePrice(category, temperature) {
            if (category === 'Food' || category === 'Bottle 1L') {
                return parseFloat('{{ $product->price }}');
            }
            return temperature === 'hot' ? parseFloat('{{ $product->hot_price }}') : parseFloat('{{ $product->ice_price }}');
        }

        function updatePrice() {
            const temperature = document.getElementById('productTemperature').value;
            const quantity = document.getElementById('productQuantity').value;
            const price = calculatePrice('{{ $product->category }}', temperature);
            const totalPrice = price * quantity;
            document.getElementById('priceDisplay').textContent = `Rp${totalPrice.toLocaleString()}`;
        }

        function updateCard(totalPrice, quantity) {
            document.getElementById('cardTotalPrice').textContent = `Price: Rp${totalPrice.toLocaleString()}`;
            document.getElementById('cardQuantity').textContent = `Quantity: ${quantity}`;
        }
    </script>
</x-app-layout>
