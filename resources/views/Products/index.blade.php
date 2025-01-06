<x-app-layout>
    <div class="bg-white min-h-screen">
    <div class="bg-white w-full flex justify-start mb-6">
        <a href="{{ route('cart.index') }}"
            class="ms-auto bg-red-600 text-white hover:bg-red-700 transition duration-300 px-4 py-2 rounded-lg shadow-md text-sm font-semibold transform hover:scale-105 flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
            </svg>
            <span>View Cart</span>
        </a>
    </div>

    <!-- Category Filter - Positioned at the top left -->
    <div class="ms-auto flex justify-start">
        <form action="{{ route('products.index') }}" method="GET" class="flex items-center space-x-4">
            <select name="category" class="border border-gray-300 rounded-lg py-2 px-4">
                <option value="">All Categories</option>
                <option value="Non-Coffee" {{ request('category') == 'Non-Coffee' ? 'selected' : '' }}>Non-Coffee</option>
                <option value="Espresso Based" {{ request('category') == 'Espresso Based' ? 'selected' : '' }}>Espresso Based</option>
                <option value="Manual Brew" {{ request('category') == 'Manual Brew' ? 'selected' : '' }}>Manual Brew</option>
                <option value="Bottle 1L" {{ request('category') == 'Bottle 1L' ? 'selected' : '' }}>Bottle 1L</option>
                <option value="Food" {{ request('category') == 'Food' ? 'selected' : '' }}>Food</option>
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md text-sm font-semibold">
                Apply Filter
            </button>
        </form>
    </div>

    <div class="bg-white mb-20">
        <!-- Display Products Based on Selected Category -->
        @if($products->isEmpty())
            <div class="text-center text-gray-500 mt-6">
                No products available.
            </div>
        @else
            @foreach($products->groupBy('category') as $category => $productsInCategory)
                <!-- Check if the current category matches the selected category -->
                @if(request('category') == '' || request('category') == $category)
                    <div class="mb-6">
                        <!-- Category Header -->
                        <h2 class="text-2xl font-semibold text-gray-800 mt-6 mb-3">{{ ucfirst($category) }}</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 mb-6">
                            @foreach($productsInCategory as $product)
                                <div class="card bg-base-100 shadow-xl w-full max-w-xs mx-auto">
                                    <a href="{{ route('Products.show', $product->id) }}">
                                        <figure>
                                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded-t-lg" />
                                        </figure>
                                    </a>
                                    <div class="card-body p-4">
                                        <h2 class="card-title text-xl font-semibold">
                                            {{ $product->name }}
                                        </h2>
                                        <p class="text-sm text-gray-500">{{ $product->description }}</p>
                                        <div class="mt-4 flex justify-between items-center">
                                        <div class="mt-4 flex justify-between items-center">
                                            <!-- No Edit and Delete buttons for regular users -->
                                            <a href="{{ route('Products.show', $product->id) }}"
                                                class="bg-red-500 text-white hover:bg-red-600 transition duration-300 px-4 py-2 rounded-lg shadow-md text-sm font-semibold transform hover:scale-105 flex items-center space-x-2">
                                                 <span>View Details</span>
                                             </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
</div>
</x-app-layout>
