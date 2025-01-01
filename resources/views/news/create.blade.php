<x-app-layout>
    <div class="bg-white min-h-screen">
        <div class="container mx-auto p-6">
            <h1 class="text-3xl font-bold mb-5">Add News</h1>

            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="title" class="block">Title</label>
                        <input type="text" name="title" id="title" required class="w-full p-2 border rounded" />
                    </div>

                    <div>
                        <label for="image" class="block">Image</label>
                        <input type="file" name="image" id="image" accept="image/*" class="w-full p-2 border rounded" />
                    </div>

                    <div>
                        <label for="content" class="block">Content</label>
                        <textarea name="content" id="content" required class="w-full p-2 border rounded" rows="4"></textarea>
                    </div>

                    <div>
                        <label for="upload_date" class="block">Upload Date</label>
                        <input type="date" name="upload_date" id="upload_date" required class="w-full p-2 border rounded" />
                    </div>

                    <!-- Add spacing for the button -->
                    <div class="mt-8">
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition">
                            Add News
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
