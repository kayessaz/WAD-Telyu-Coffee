<x-app-layout>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="max-w-6xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        @csrf
        <h2 class="text-2xl font-semibold mb-6 text-center">Create Product</h2>

        <div class="space-y-6">
            <!-- Name Field -->
            <div>
                <label for="name" class="font-medium block mb-1">Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="w-full border-gray-300 border rounded-lg py-2 px-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('name') }}"
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
                >{{ old('description') }}</textarea>
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
                    <option value="">Select Category</option>
                    <option value="Non-Coffee">Non-Coffee</option>
                    <option value="Espresso Based">Espresso Based</option>
                    <option value="Manual Brew">Manual Brew</option>
                    <option value="Bottle 1L">Bottle 1L</option>
                    <option value="Food">Food</option>
                </select>

                <!-- Custom Category Input (Appears when selecting "Other") -->
                <input
                type="text"
                name="new_category"
                id="new_category"
                class="w-full border-gray-300 border rounded-lg py-2 px-4 shadow-sm mt-2 hidden focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Type new category"
                style="display:none;"
                value="{{ old('new_category') }}">
                
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
                        value="{{ old('hot_price') }}"
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
                        value="{{ old('ice_price') }}"
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
                        value="{{ old('price') }}"
                        step="0.01"
                    >
                </div>
            </div>

            <!-- Image Upload Field with Preview -->
            <div>
                <label for="image_url" class="font-medium block mb-1">Image</label>
                <input
                    type="file"
                    name="image_url"
                    id="image_url"
                    class="w-full border-gray-300 border rounded-lg py-2 px-4 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    onchange="previewImage(event)"
                >
                <img id="image-preview" src="" alt="Image preview" class="mt-2 max-w-xs" style="display: none;">
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button
                    type="submit"
                    class="bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 px-6 py-3 rounded-lg shadow-lg transform hover:scale-105"
                >
                    Create Product
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
