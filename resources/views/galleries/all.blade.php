<x-app-layout>
    <div class="bg-white min-h-screen">
        <div class="container mx-auto p-6">
            <h1 class="text-3xl font-bold mb-5">All Galleries</h1>

            @if($galleries->isEmpty())
                <p class="text-gray-600">No gallery items available.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-white">
                    @foreach($galleries as $gallery)
                        <div class="relative gallery-item bg-white p-4 rounded-lg shadow-lg flex flex-col">
                            <!-- Image -->
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="Image" class="w-full h-auto rounded-md">

                            <!-- Description -->
                            <p class="text-gray-800 font-semibold">{{ $gallery->description }}</p>
                            <small class="text-gray-500">Uploaded by {{ $gallery->user->name }} on {{ $gallery->created_at->format('d M Y') }}</small>

                            <!-- Delete Button (Admin only) -->
                            @if(auth()->check() && auth()->user()->email == 'admin@gmail.com')
                                <form action="{{ route('galleries.delete', $gallery->id) }}" method="POST" class="absolute bottom-4 right-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-700 transition duration-200">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Display success or error message -->
            @if(session('success'))
                <div class="mt-4 text-green-600">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="mt-4 text-red-600">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
