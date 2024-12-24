<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-5">All Reviews</h1>

        @if($reviews->isEmpty())
            <p class="text-gray-600">No reviews available.</p>
        @else
            <div class="space-y-4">
                @foreach($reviews as $review)
                    <div class="bg-white p-4 rounded-lg shadow-lg">
                        <h3 class="text-xl font-bold">{{ $review->message }}</h3>
                        <p class="text-sm text-gray-700">Rating: {{ $review->rating }}/10</p>
                        <small class="text-gray-500">By {{ $review->user->name }} on {{ $review->created_at->format('d M Y') }}</small>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
