<x-app-layout>
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="max-w-6xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        @csrf
        @method('PUT')
        <h2 class="text-2xl font-semibold mb-6 text-center">Update Product</h2>

        <div class="space-y-6">
            <!-- Name Field -->
            <div>
                <label for="name" class="font-medium block mb-1">Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="w-full border-gray-300 border rounded-lg py-2 px-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    value="{{ old('name', $product->name) }}" 
                    required
                >
            </div>

            <!-- Description Field -->
            <div>
                <label for="description" class="font-medium block mb-1">Description</label>
                <textarea 
                    name="description" 
                    id="description" 
                    class="w-full border-gray-300 border rounded-lg py-2 px-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required
                >{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Hot Price Field -->
            <div>
                <label for="hot_price" class="font-medium block mb-1">Hot Price</label>
                <input 
                    type="number" 
                    name="hot_price" 
                    id="hot_price" 
                    class="w-full border-gray-300 border rounded-lg py-2 px-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    value="{{ old('hot_price', $product->hot_price) }}" 
                    step="0.01"
                >
            </div>

            <!-- Ice Price Field -->
            <div>
                <label for="ice_price" class="font-medium block mb-1">Ice Price</label>
                <input 
                    type="number" 
                    name="ice_price" 
                    id="ice_price" 
                    class="w-full border-gray-300 border rounded-lg py-2 px-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    value="{{ old('ice_price', $product->ice_price) }}" 
                    step="0.01"
                >
            </div>

            <!-- Image Upload Field -->
            <div>
                <label for="image_url" class="font-medium block mb-1">Image</label>
                <input 
                    type="file" 
                    name="image_url" 
                    id="image_url" 
                    class="w-full border-gray-300 border rounded-lg py-2 px-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                @if ($product->image_url)
                    <img src="{{ asset($product->image_url) }}" alt="Product Image" class="mt-4 w-32">
                @endif
            </div>

            <!-- Category Selection -->
            <div>
                <label for="category" class="font-medium block mb-1">Category</label>
                <div class="relative">
                    <select 
                        name="category" 
                        id="category" 
                        class="w-full border-gray-300 border rounded-lg py-2 px-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                        onchange="enableCustomCategory(this)">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ $category === $product->category ? 'selected' : '' }}>{{ ucfirst($category) }}</option>
                        @endforeach
                        <option value="Other">Other</option> <!-- Added the "Other" option -->
                    </select>

                    <!-- Custom Category Input (Appears when selecting "Other") -->
                    <input 
                        type="text" 
                        name="new_category" 
                        id="new_category" 
                        class="w-full border-gray-300 border rounded-lg py-2 px-4 shadow-sm mt-2 hidden focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Type new category" 
                        style="display:none;" 
                        value="{{ old('new_category') }}"
                    >
                </div>
            </div>

            <script>
                function enableCustomCategory(selectElement) {
                    const customCategoryInput = document.getElementById('new_category');
                    const selectedValue = selectElement.value;
                    
                    // Show the custom category input when "Other" is selected
                    if (selectedValue === "Other") {
                        customCategoryInput.style.display = "block";
                    } else {
                        customCategoryInput.style.display = "none"; // Hide input for other selections
                    }
                }
            </script>

            <!-- Submit Button -->
            <div class="text-center">
                <button 
                    type="submit" 
                    class="bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 px-6 py-3 rounded-lg shadow-lg transform hover:scale-105"
                >
                    Update Product
                </button>
            </div>
        </div>
    </form>
</x-app-layout>
