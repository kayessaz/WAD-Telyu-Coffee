<x-app-layout>
    <div class="bg-white min-h-screen mt-5">
        <h3 class="text-xl font-semibold mb-5">Your Order:</h3>
        <div class="flex flex-col md:flex-row rounded-lg shadow-md flex-grow justify-between">
            <div class="w-full md:w-2/3 mb-8 md:mb-0 ml-5">
                <ul>
                    @foreach ($cartItems as $cartItem)
                    <li class="mb-4 flex items-center">
                        <img src="{{ asset($cartItem->product->image_url) }}" class="w-16 h-16 object-cover mr-4 rounded-md" alt="{{ $cartItem->product->name }}">
                        <div class="flex-grow">
                            <div class="flex justify-between">
                                <h4 class="text-lg font-semibold">
                                    {{ $cartItem->product->name }}
                                    @if(in_array($cartItem->product->category, ['Espresso Based', 'Manual Brew', 'Non-Coffee']))
                                        ({{ ucfirst($cartItem->temperature) }})
                                    @endif
                                </h4>
                                <!-- Category Badge -->
                                <p class="font-semibold text-red-600 bg-white border border-red-600 rounded-full py-1 px-3 text-xs mr-4">
                                    {{ $cartItem->product->category }}
                                </p>
                            </div>
                            <!-- Quantity and Price in one row -->
                            <div class="flex items-center">
                                <p class="text-gray-600 mr-2">{{ $cartItem->quantity }} x </p>
                                <p class="text-gray-800">
                                    Rp.
                                    @if($cartItem->temperature === 'general')
                                        {{ $cartItem->product->price }}
                                    @else
                                        {{ $cartItem->temperature === 'hot' ? $cartItem->product->hot_price : $cartItem->product->ice_price }}
                                    @endif
                                </p>
                            </div>
                            <!-- Subtotal in one row -->
                            <div class="flex items-center">
                                <p class="text-red-700 font-semibold">Subtotal:</p>
                                <p class="ml-1 text-gray-800 font-semibold"> Rp.
                                    @if($cartItem->temperature === 'general')
                                        {{ $cartItem->product->price * $cartItem->quantity }}
                                    @else
                                        {{ ($cartItem->temperature === 'hot' ? $cartItem->product->hot_price : $cartItem->product->ice_price) * $cartItem->quantity }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <p class="text-md font-semibold text-red-700 mt-4">Total Price: Rp. {{ $totalPrice }}</p>
                <h3 class="text-md text-red-700">Tax (12%): Rp. {{ $totalPrice * 0.12 }}</h3>
                <h3 class="text-lg font-bold text-red-900">Grand Total: Rp. {{ $totalPrice + ($totalPrice * 0.12) }}</h3>
            </div>

            <div class="w-full md:w-1/2">
                <form action="{{ route('checkout.process') }}" method="post" class="bg-red-700 bg-opacity-100 p-6 rounded-md" id="checkout-form">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-100">Order Type</label>
                        <div class="mt-2">
                            <label class="inline-flex ml-6 items-center">
                                <input type="radio" name="delivery_option" value="makan_di_tempat" class="form-radio text-red-700" onclick="toggleOrderFields()">
                                <span class="ml-2 text-gray-100">Dine In</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" name="delivery_option" value="bawa_pulang" class="form-radio text-red-700" onclick="toggleOrderFields()">
                                <span class="ml-2 text-gray-100">Take Away</span>
                            </label>
                        </div>
                    </div>

                    <div class="mb-4 dine-in-fields hidden">
                        <label for="name" class="block text-sm font-medium text-gray-100">Full Name</label>
                        <input type="text" name="name" id="name" class="mt-1 p-2 w-full border rounded-md bg-white" value="{{ auth()->user()->name }}" disabled>

                        <label for="email" class="block text-sm font-medium text-gray-100">Email Address</label>
                        <input type="email" name="email" id="email" class="mt-1 p-2 w-full border rounded-md bg-white" value="{{ old('email', auth()->user()->email) }}">

                        <label for="phone" class="block text-sm font-medium text-gray-100">Phone Number</label>
                        <input type="text" name="phone" id="phone" class="mt-1 p-2 w-full border rounded-md bg-white" value="{{ old('phone', auth()->user()->phone) }}">

                        <label for="table" class="block text-sm font-medium text-gray-100">Table Number</label>
                        <input type="text" name="table" id="table" class="mt-1 p-2 w-full border rounded-md bg-white" value="{{ old('table') }}">
                    </div>

                    <div class="mb-4 take-away-fields hidden">
                        <label for="name" class="block text-sm font-medium text-gray-100">Full Name</label>
                        <input type="text" name="name" id="name" class="mt-1 p-2 w-full border rounded-md bg-white" value="{{ auth()->user()->name }}" disabled>

                        <label for="email" class="block text-sm font-medium text-gray-100">Email Address</label>
                        <input type="email" name="email" id="email" class="mt-1 p-2 w-full border rounded-md bg-white" value="{{ old('email', auth()->user()->email) }}">

                        <label for="phone" class="block text-sm font-medium text-gray-100">Phone Number</label>
                        <input type="text" name="phone" id="phone" class="mt-1 p-2 w-full border rounded-md bg-white" value="{{ old('phone', auth()->user()->phone) }}">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-100">Choose Payment</label>
                        <div class="mt-2">
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" name="payment_option" value="Online Payment" class="form-radio text-red-700 option-input">
                                <span class="ml-2 text-gray-100">Online Payment</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" name="payment_option" value="Cash" class="form-radio text-red-700 option-input">
                                <span class="ml-2 text-gray-100">Pay at Cashier</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="bg-white text-red-700 px-4 py-2 rounded-md hover:bg-gray-200 focus:outline-none focus:shadow-outline-white active:bg-red-700">
                        Confirm Payment
                    </button>
                </form>
            </div>

            <script>
                // Toggle fields based on order type
                function toggleOrderFields() {
                    const dineInFields = document.querySelector('.dine-in-fields');
                    const takeAwayFields = document.querySelector('.take-away-fields');

                    const isDineIn = document.querySelector('input[name="delivery_option"]:checked').value === 'makan_di_tempat';

                    if (isDineIn) {
                        dineInFields.classList.remove('hidden');
                        takeAwayFields.classList.add('hidden');
                    } else {
                        takeAwayFields.classList.remove('hidden');
                        dineInFields.classList.add('hidden');
                    }
                }
            </script>

        </div>
    </div>
</x-app-layout>
