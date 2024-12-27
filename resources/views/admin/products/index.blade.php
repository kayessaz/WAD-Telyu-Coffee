<x-app-layout>
    <div class="container">
        <!-- FILTER MENU -->
        <div class="mb-6">
            <form method="GET" action="{{ route('admin.products.index') }}">
                <label for="filter" class="font-semibold mr-2">Filter Kategori:</label>
                <select name="filter" id="filter" onchange="this.form.submit()" class="border-gray-300 rounded shadow py-2 px-3">
                    <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>All</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('filter') == $category ? 'selected' : '' }}>{{ ucfirst($category) }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <a href="{{ route('admin.products.create') }}" class="fixed bottom-4 right-4 bg-blue-400 hover:bg-blue-100 text-gray-100 hover:text-gray-800 font-semibold py-2 px-4 rounded-lg shadow transition duration-300 ease-in-out transform hover:scale-105">
            Add Product
        </a>
    </div>

    <div class="container mt-8 pb-8">
        <h3 class="text-2xl font-bold mb-6">Products</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach($products as $product)
                <div class="card bg-base-100 shadow-xl w-full max-w-xs mx-auto">
                    <a href="{{ route('admin.products.show', $product->id) }}">
                        <figure>
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded-t-lg" />
                        </figure>
                    </a>
                    <div class="card-body p-4">
                        <h2 class="card-title text-xl font-semibold">
                            {{ $product->name }}
                            <div class="badge badge-secondary">{{ ucfirst($product->category) }}</div>
                        </h2>
                        <p class="text-sm text-gray-500">{{ $product->description }}</p>
                        <div class="mt-4 flex justify-between items-center">
                            <!-- Edit Button -->
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="bg-yellow-500 text-white hover:bg-yellow-600 transition duration-300 px-4 py-2 rounded-lg shadow-md text-sm font-semibold transform hover:scale-105 flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4h4v4M6 14l3 3h8l3-3M9 4l5 5 5-5M5 20h14a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2z"/>
                                </svg>
                                <span>Edit</span>
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white hover:bg-red-600 transition duration-300 px-4 py-2 rounded-lg shadow-md text-sm font-semibold transform hover:scale-105 flex items-center space-x-2">
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
</x-app-layout>
