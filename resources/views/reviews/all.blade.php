<x-app-layout>
    <div class="bg-white min-h-screen">
        <div class="container mx-auto p-6">
            <h1 class="text-3xl font-bold mb-5">All Reviews</h1>

            @if($reviews->isEmpty())
                <p class="text-gray-600">No reviews available.</p>
            @else
                <div class="space-y-4">
                    @foreach ($reviews as $review)
                        <div class="relative review-item p-4 border rounded-lg shadow-md bg-white flex justify-between items-center">
                            <!-- Title and Rating Section -->
                            <div class="flex-1">
                                <h3 class="text-xl font-semibold text-gray-800">{{ $review->message }}</h3>
                                <p class="text-sm text-yellow-500">
                                    Rating: {{ $review->rating }} / 5
                                </p>
                                <!-- Review Content -->
                                <p class="text-gray-700">{{ $review->content }}</p>
                                <small class="text-gray-500">By {{ $review->user->name }} on {{ $review->created_at->format('d M Y') }}</small>
                            </div>

                            <!-- Delete Button (Admin only) -->
                            @if(auth()->check() && auth()->user()->email == 'admin@gmail.com')
                                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="ml-4">
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
