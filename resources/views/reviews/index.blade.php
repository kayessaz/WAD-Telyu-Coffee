<x-app-layout>
    <div class="container mx-auto p-6">

        @if(auth()->user()->email == 'admin@gmail.com')
            <a href="{{ route('reviews.create') }}" class="btn btn-primary btn-small mb-4">Add Review</a>
        @else
            <a href="{{ route('reviews.create') }}" class="btn btn-primary btn-small mb-4">Add Your Review</a>
        @endif
        <h1 class="text-3xl font-bold mb-5">Your Reviews</h1>
        @if(session('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                <span class="font-medium">Error!</span> {{ session('error') }}
            </div>
        @endif

        @if($reviews->isEmpty())
            <p class="text-gray-600">No reviews found.</p>
        @else
            <div class="space-y-4">
                @foreach($reviews as $review)
                    <div class="review bg-gray-100 p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold">{{ $review->message }}</h3>
                        <p class="text-sm text-gray-700">Rating: {{ $review->rating }}/10</p>
                        <small class="text-gray-500">By {{ $review->user->name }} on {{ $review->created_at->format('d M Y') }}</small>

                        <div class="review-buttons flex gap-2 mt-2">
                            @if(auth()->user()->id == $review->user_id || auth()->user()->email == 'admin@gmail.com')
                                <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-primary">Edit</a>
                            @endif

                            @if(auth()->user()->id == $review->user_id || auth()->user()->email == 'admin@gmail.com')
                                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
