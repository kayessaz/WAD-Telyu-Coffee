<x-app-layout>
    <div class="bg-white min-h-screen flex justify-center items-center pb-20">
        <div class="bg-white p-6 rounded-lg flex flex-col md:flex-row w-full max-w-7xl">
            <div class="flex flex-col w-full md:w-1/2">
                <img id="mainImage" src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-[500px] rounded-xl shadow-xl object-cover mb-4" />
            </div>
            <div class="w-full md:w-1/2 bg-white text-red-700 rounded-lg p-6 ml-0 md:ml-8">
                <p class="mt-2 font-semibold text-red-500 mb-3">{{ $product->category }}</p>
                <h3 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h3>
                <p class="mt-5 font-semibold">Description:</p>
                <p class="mt-2 text-lg leading-8 text-gray-600 mb-5">{{ $product->description }}</p>

                @if($product->category == 'Food' || $product->category == 'Bottle 1L')
                <p class="mt-5 font-semibold">Price:</p>
                <p class="text-lg text-gray-800">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                @else
                <p class="mt-5 font-semibold">Price (Ice):</p>
                <p class="text-lg text-gray-800">Rp{{ number_format($product->ice_price, 0, ',', '.') }}</p>
                <p class="mt-2 font-semibold">Price (Hot):</p>
                <p class="text-lg text-gray-800">Rp{{ number_format($product->hot_price, 0, ',', '.') }}</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
