<style>
    .custom-image {
        max-width: 200px;
        height: auto;
    }
    .news-item {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
    }
    .actions {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        display: flex;
        flex-direction: column;
        gap: 10px;
        visibility: visible; /* Pastikan tombol selalu terlihat */
        opacity: 1; /* Hilangkan pengaturan opacity */
    }
    .edit-btn {
        background-color: #d1d5db;
        color: #333;
        padding: 8px 16px;
        border-radius: 4px;
        text-align: center;
        font-weight: bold;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }
    .edit-btn:hover {
        background-color: #9ca3af;
    }
    .delete-btn {
        background-color: #f87171;
        color: #fff;
        padding: 8px 16px;
        border-radius: 4px;
        text-align: center;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .delete-btn:hover {
        background-color: #ef4444;
    }
</style>

<x-app-layout>
    <div class="bg-white min-h-screen">
        <!-- Add News Button -->
        @if (auth()->check() && auth()->user()->email == 'admin@gmail.com') <!-- Menampilkan tombol hanya untuk admin -->
            <div class="flex justify-end mb-5">
                <a href="{{ route('news.create') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow-lg hover:bg-blue-600 transition duration-300">
                    Add News
                </a>
            </div>
        @endif

        <h1 class="text-3xl font-bold mb-5">All News</h1>

        @if($news->isEmpty())
            <p class="text-gray-600">No news available.</p>
        @else
            <div class="space-y-4">
                @foreach($news as $item)
                    <div class="bg-white p-4 rounded-lg shadow-lg relative news-item">
                        <div class="flex flex-col md:flex-row items-start mb-6">
                            <!-- Image Section -->
                            <div class="md:w-1/4 mb-6 md:mb-0 flex-shrink-0 mr-4">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="custom-image object-cover rounded">
                            </div>

                            <!-- Content Section -->
                            <div class="md:w-3/4 md:ml-4 mt-4 md:mt-0">
                                <p class="text-sm text-gray-500 mb-2">{{ \Carbon\Carbon::parse($item->upload_date)->format('d M Y') }}</p>
                                <h3 class="text-xl font-bold mb-2">
                                    {{ $item->title }}
                                </h3>
                                <a href="{{ route('news.show', $item->id) }}" class="text-blue-500 hover:underline">Read More</a>

                                <!-- Admin Controls - Edit and Delete -->
                                @if (auth()->check() && auth()->user()->email == 'admin@gmail.com')
                                    <div class="actions">
                                        <a href="{{ route('news.edit', $item->id) }}" class="edit-btn">Edit</a>
                                        <form action="{{ route('news.destroy', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this news?');">Delete</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
