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

            <!-- Category Selection -->
            <div class="form-group">
                <label for="category" class="font-medium block mb-1">Category</label>
                <select
                    id="category"
                    name="category"
                    class="w-full border-gray-300 border rounded-lg py-2 px-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required
                >
                    @foreach ($categories as $category)
                        @if (old('category', $product->category) == $category["name"])
                            <option value="{{ $category["name"] }}" selected>{{ $category["name"] }}</option>
                        @else
                            <option value="{{ $category["name"] }}">{{ $category["name"] }}</option>
                        @endif
                    @endforeach

                    {{-- <option value="">Select Category</option>
                    <option value="Non-Coffee">Non-Coffee</option>
                    <option value="Espresso Based">Espresso Based</option>
                    <option value="Manual Brew">Manual Brew</option>
                    <option value="Bottle 1L">Bottle 1L</option>
                    <option value="Food">Food</option> --}}
                </select>
            </div>

            <!-- Hot/Ice Price Section -->
            <div id="hot-ice-price-section">
                <div class="form-group">
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

                <div class="form-group">
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
            </div>

            <!-- General Price Section -->
            <div id="general-price-section" style="display: none;">
                <div class="form-group">
                    <label for="price" class="font-medium block mb-1">Price</label>
                    <input
                        type="number"
                        name="price"
                        id="price"
                        class="w-full border-gray-300 border rounded-lg py-2 px-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('price', $product->price) }}"
                        step="0.01"
                    >
                </div>
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

    <script>
        document.getElementById('category').addEventListener('change', function () {
            const category = this.value;
            const hotIceSection = document.getElementById('hot-ice-price-section');
            const generalPriceSection = document.getElementById('general-price-section');

            if (category === 'Bottle 1L' || category === 'Food') {
                hotIceSection.style.display = 'none';
                generalPriceSection.style.display = 'block';
            } else {
                hotIceSection.style.display = 'block';
                generalPriceSection.style.display = 'none';
            }
        });

        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function () {
                const imagePreview = document.getElementById('image-preview');
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

</x-app-layout>
