<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Review - Tel-U Coffee</title>
    <!-- Styles -->
    @vite('resources/css/app.css')
</head>

<body class="antialiased">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-5">Your Review</h1>
        <p class="mb-5">Here is the review you submitted.</p>

        <!-- Review Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div class="mb-4">
                    <strong>First Name: </strong>{{ $review->first_name }}
                </div>
                <div class="mb-4">
                    <strong>Last Name: </strong>{{ $review->last_name }}
                </div>
                <div class="mb-4">
                    <strong>Phone: </strong>{{ $review->phone }}
                </div>
                <div class="mb-4">
                    <strong>Email: </strong>{{ $review->email }}
                </div>
                <div class="mb-4">
                    <strong>Rating: </strong>{{ $review->rating }}/10
                </div>
                <div class="mb-4">
                    <strong>Review Message: </strong>{{ $review->message }}
                </div>

                <!-- Image -->
                @if($review->image)
                    <div class="mb-4">
                        <strong>Image: </strong>
                        <img src="{{ asset('storage/' . $review->image) }}" alt="Review Image" class="w-full h-auto max-w-xs rounded-lg">
                    </div>
                @endif

                <!-- Edit and Delete Buttons -->
                <div class="mt-4">
                    <a href="{{ route('reviews.edit', $review->id) }}" class="bg-yellow-500 text-white py-2 px-4 rounded">Edit Review</a>
                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="inline-block ml-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded">Delete Review</button>
                    </form>
                </div>
            </div>

            <div>
                <img src="{{ asset('photos/telyucoffee-2.png') }}" alt="Product Dashboard" class="w-full h-full max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10 sm:w-[60rem] md:-ml-4 lg:-ml-0" width="450" height="250">
            </div>
        </div>
    </div>
</body>

</html>
