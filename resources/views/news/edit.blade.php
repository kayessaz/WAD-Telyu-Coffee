<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-5">Edit News</h1>

        <form action="{{ route('news.update', $newsItem->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-lg font-medium">Title</label>
                <input type="text" id="title" name="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ $newsItem->title }}" required>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-lg font-medium">Content</label>
                <textarea id="content" name="content" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>{{ $newsItem->content }}</textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update News</button>
        </form>
    </div>
</x-app-layout>
