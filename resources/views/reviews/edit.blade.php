<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Review - Tel-U Coffee</title>
    <!-- Styles -->
    @vite('resources/css/app.css')
</head>

<body class="antialiased">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-5">Edit Your Review</h1>
        <p class="mb-5">Make any changes to your review below and submit it again.</p>

        <!-- Edit Form -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <form action="{{ route('reviews.update', $review->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label for="first_name" class="block">First Name</label>
                            <input type="text" name="first_name" id="first_name" value="{{ $review->first_name }}" required class="w-full p-2 border rounded" />
                        </div>

                        <div>
                            <label for="last_name" class="block">Last Name</label>
                            <input type="text" name="last_name" id="last_name" value="{{ $review->last_name }}" required class="w-full p-2 border rounded" />
                        </div>

                        <div>
                            <label for="phone" class="block">Phone</label>
                            <input type="text" name="phone" id="phone" value="{{ $review->phone }}" required class="w-full p-2 border rounded" />
                        </div>

                        <div>
                            <label for="email" class="block">Email</label>
                            <input type="email" name="email" id="email" value="{{ $review->email }}" required class="w-full p-2 border rounded" />
                        </div>

                        <!-- Rating input field -->
                        <div>
                            <label for="rating" class="block">Rating (1/10)</label>
                            <input type="number" name="rating" id="rating" min="1" max="10" value="{{ $review->rating }}" required class="w-full p-2 border rounded" />
                        </div>

                        <div>
                            <label for="message" class="block">Write Your Review</label>
                            <textarea name="message" id="message" required class="w-full p-2 border rounded" rows="4">{{ $review->message }}</textarea>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update Review</button>
                        </div>
                    </div>
                </form>
            </div>

            <div>
                <img src="{{ asset('photos/telyucoffee-2.png') }}" alt="Product Dashboard" class="w-full h-full max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10 sm:w-[60rem] md:-ml-4 lg:-ml-0" width="450" height="250">
            </div>
        </div>
    </div>
</body>

</html>
