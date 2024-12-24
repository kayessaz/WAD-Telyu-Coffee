<x-app-layout>

    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-5">Review</h1>
        <p class="mb-5">Fill out the form below and we’ll be in touch soon.</p>

        <!-- Contact Form and Image Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="first_name" class="block">First Name</label>
                            <input type="text" name="first_name" id="first_name" required class="w-full p-2 border rounded" />
                        </div>

                        <div>
                            <label for="last_name" class="block">Last Name</label>
                            <input type="text" name="last_name" id="last_name" required class="w-full p-2 border rounded" />
                        </div>

                        <div>
                            <label for="phone" class="block">Phone</label>
                            <input type="text" name="phone" id="phone" required class="w-full p-2 border rounded" />
                        </div>

                        <div>
                            <label for="email" class="block">Email</label>
                            <input type="email" name="email" id="email" required class="w-full p-2 border rounded" />
                        </div>

                        <div>
                            <label for="rating" class="block">Rating (1/10)</label>
                            <input type="number" name="rating" id="rating" min="1" max="10" required class="w-full p-2 border rounded" />
                        </div>

                        <div>
                            <label for="message" class="block">Write Your Review</label>
                            <textarea name="message" id="message" required class="w-full p-2 border rounded" rows="4"></textarea>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Send Review</button>
                        </div>
                    </div>
                </form>
            </div>

            <div>
                <img src="{{ asset('photos/telyucoffee-2.png') }}" alt="Product Dashboard" class="w-full h-full max-w-none rounded-xl shadow-xl ring-1 ring-gray-400/10 sm:w-[60rem] md:-ml-4 lg:-ml-0" width="450" height="250">
            </div>
        </div>
    </div>

</x-app-layout>
