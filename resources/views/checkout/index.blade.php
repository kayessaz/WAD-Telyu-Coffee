<!-- resources/views/checkout/index.blade.php -->
<x-app-layout>
    <div class="container-fluid mt-10 sm:mx-auto sm:w-full sm:max-w-xl overflow-hidden py-6 sm:py-6 text-gray-800">
        <div class="flex flex-col md:flex-row justify-between">
            <div class="w-full md:w-1/2 mb-8 md:mb-0">
                <h3 class="text-xl font-semibold mb-4">Pesanan Anda : </h3>
                <ul>
                    @foreach ($cartItems as $cartItem)
                    <li class="mb-2">
                        {{ $cartItem->product->name }} - Quantity: {{ $cartItem->quantity }} - Rp. {{ $cartItem->product->price }}
                    </li>
                    @endforeach
                </ul>
                <p class="mt-4 text-xl font-bold">Total: Rp. {{ $totalPrice }}</p>
            </div>

            <div class="w-full md:w-1/2">
                <form action="{{ route('checkout.process') }}" method="post" class="bg-gray-100 p-6 rounded-md">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Atas Nama</label>
                        <input type="text" name="name" id="name" class="mt-1 p-2 w-full border rounded-md bg-white" value="{{ auth()->user()->name }}" disabled>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <input type="email" name="email" id="email" class="mt-1 p-2 w-full border rounded-md bg-white" value="{{ auth()->user()->email }}" disabled>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Pilih Opsi</label>
                        <div class="mt-2">
                            <label class="inline-flex ml-6 items-center">
                                <input type="radio" name="delivery_option" value="makan_di_tempat" class="form-radio text-green-500">
                                <span class="ml-2">Dine in</span>
                            </label>
                            <label class="inline-flex items-center ml-6">
                                <input type="radio" name="delivery_option" value="bawa_pulang" class="form-radio text-green-500">
                                <span class="ml-2">Take away</span>
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Pilih Metode Pembayaran</label>
                        <div class="mt-2">
                            <label class="inline-flex items-center ml-6 option-label">
                                <input type="radio" name="payment_option" value="credit_card" class="form-radio text-blue-500 option-input">
                                <span class="ml-2">Transfer Bank</span>
                            </label>
                            <label class="inline-flex items-center ml-6 option-label">
                                <input type="radio" name="payment_option" value="bank_transfer" class="form-radio text-blue-500 option-input">
                                <span class="ml-2">QRIS</span>
                            </label>
                            <label class="inline-flex items-center ml-6 option-label">
                                <input type="radio" name="payment_option" value="cash_on_delivery" class="form-radio text-blue-500 option-input">
                                <span class="ml-2">Bayar di Tempat</span>
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:shadow-outline-green active:bg-green-700">
                        Selesaikan Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
