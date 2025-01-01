<x-app-layout>
    <div class="container mx-auto p-6">
        <div class>
            <!-- Gambar Besar -->
            <div class="mb-6">
                <img src="{{ asset('storage/' . $newsItem->image) }}" alt="{{ $newsItem->title }}" class="w-full h-auto rounded-lg shadow-lg">
            </div>

            <!-- Tanggal -->
            <p class="text-sm text-gray-500 mb-2">{{ \Carbon\Carbon::parse($newsItem->upload_date)->format('d M Y') }}</p>

            <!-- Judul -->
            <h1 class="text-3xl font-bold mb-4">{{ $newsItem->title }}</h1>

            <!-- Konten -->
            <p class="text-lg text-gray-700">{{ $newsItem->content }}</p>
        </div>
    </div>
</x-app-layout>
