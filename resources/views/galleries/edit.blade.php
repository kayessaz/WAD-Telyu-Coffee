<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Gallery - Your Gallery</title>
    <!-- Styles -->
    @vite('resources/css/app.css')
</head>

<body class="antialiased">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-5">Edit Gallery Item</h1>
        <p class="mb-5">Make any changes to your gallery item below and save them.</p>

        <!-- Edit Form -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <form action="{{ route('galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label for="description" class="block">Description</label>
                            <textarea name="description" id="description" class="w-full p-2 border rounded" rows="4" required>{{ $gallery->description }}</textarea>
                        </div>

                        <div>
                            <label for="image" class="block">Upload New Image</label>
                            <input type="file" name="image" id="image" class="w-full p-2 border rounded">
                            <small class="text-gray-500">Leave empty if you don't want to change the image.</small>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>

            <div>
                <h2 class="text-xl font-semibold mb-3">Current Image</h2>
                <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="Gallery Image" class="w-full h-auto rounded shadow">
            </div>
        </div>
    </div>
</body>

</html>
