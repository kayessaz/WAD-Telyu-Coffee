<x-app-layout>
    <div class="bg-white min-h-screen">
    <div class="mb-6 flex justify-end">
        <a href="{{ route('admin.products.create') }}"
           class="bg-blue-500 text-white hover:bg-blue-600 transition duration-300 px-4 py-2 rounded-lg shadow-md text-sm font-semibold transform hover:scale-105 flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Add Menu</span>
        </a>
    </div>

    <!-- Category Filter - Positioned at the top left -->
    <div class="mb-6 flex justify-start">
        <form action="{{ route('admin.products.index') }}" method="GET" class="flex items-center space-x-4">
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

    <div class="bg-white">
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
                        <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ ucfirst($category) }}</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                            @foreach($productsInCategory as $product)
                                <div class="card bg-base-100 shadow-xl w-full max-w-xs mx-auto">
                                    <a href="{{ route('admin.products.show', $product->id) }}">
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
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                               class="bg-gray-500 text-white hover:bg-gray-600 transition duration-300 px-4 py-2 rounded-lg shadow-md text-sm font-semibold transform hover:scale-105 flex items-center space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4h4v4M6 14l3 3h8l3-3M9 4l5 5 5-5M5 20h14a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2z"/>
                                                </svg>
                                                <span>Edit</span>
                                            </a>
                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="bg-red-600 text-white hover:bg-red-700 transition duration-300 px-4 py-2 rounded-lg shadow-md text-sm font-semibold transform hover:scale-105 flex items-center space-x-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                    <span>Delete</span>
                                                </button>
                                            </form>
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
