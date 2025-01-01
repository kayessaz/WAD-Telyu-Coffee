<x-app-layout>
    <div class="bg-white min-h-screen">
        <h1 class="text-3xl font-bold mb-5">All Gallery</h1>

        @if($galleries->isEmpty())
            <p>No gallery items available.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($galleries as $gallery)
                    <div class="bg-white p-4 rounded shadow-lg">
                        <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="Image" class="w-full h-auto">
                        <p class="mt-2">{{ $gallery->description }}</p>
                        <small>Uploaded by {{ $gallery->user->name }}</small>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
