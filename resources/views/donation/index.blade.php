<x-app-layout>
    <div class="bg-white min-h-screen">
    @if(auth()->user()->email == 'admin@gmail.com')
            <h1 class="text-2xl font-bold mb-4">Donation Records</h1>
            @if(count($donations) > 0)
                <table class="table-auto w-full border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100 text-gray-900">
                            <th class="border px-4 py-2">Name</th>
                            <th class="border px-4 py-2">Email</th>
                            <th class="border px-4 py-2">Proof of Donation</th>
                            <th class="border px-4 py-2">Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donations as $donation)
                            <tr>
                                <td class="border px-4 py-2">{{ $donation->name }}</td>
                                <td class="border px-4 py-2">{{ $donation->email }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ asset('storage/' . $donation->proof) }}" target="_blank">View Proof</a>
                                </td>
                                <td class="border px-4 py-2">{{ $donation->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-600">No donations recorded.</p>
            @endif
        </div>
    @else
        <div class="flex flex-col md:flex-row mt-5 justify-center pb-40">
            <!-- Left Side: QRIS Image -->
            <div class="flex-shrink-0 mb-8 md:mb-0">
                <img src="{{ asset('photos/donation.png') }}" alt="QRIS" class="w-[510px] h-[760px] object-cover">
            </div>

            <!-- Right Side: Donation Form -->
            <div class="md:ml-8">
                <div class="p-6 bg-white shadow-lg rounded-lg mt-5 ">
                    <h1 class="text-2xl font-bold mb-4 text-red-900">Welcome to the Endowment Fund!</h1>
                    <p class="mb-4">Join us in creating lasting impact. Your donation to our Endowment Fund ensures future generations benefit from our mission. Every contribution matters.</p>
                    <div class="mb-4">
                        <div class="flex items-center mb-4">
                            <button onclick="downloadQris()" class="bg-red-700 text-white py-2 px-4 rounded hover:bg-red-800 transition duration-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="mr-2">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4"/>
                                </svg>
                                Download QRIS
                            </button>
                        </div>
                    </div>
                    <p class="mb-4">Follow the donation instructions below:</p>
                    <ol class="list-decimal list-inside space-y-2">
                        <li>Select your preferred method of payment.</li>
                        <li>Enter the 007 as the unique number at the end of the amount.</li>
                        <li>Provide your name, email address, and proof.</li>
                        <li>Click the "Submit Donation" button to complete your donation.</li>
                    </ol>

                    <!-- Donation Form -->
                    <form action="{{ route('donation.store') }}" method="POST" enctype="multipart/form-data" class="mt-6">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-red-900">Full Name</label>
                            <input type="text" name="name" id="name" class="mt-1 p-2 w-full border border-red-900 rounded-md bg-white" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-red-900">Email Address</label>
                            <input type="email" name="email" id="email" class="mt-1 p-2 w-full border border-red-900 rounded-md bg-white" required>
                        </div>
                        <div class="mb-4">
                            <label for="proof" class="block text-sm font-medium text-red-900">Upload Proof of Donation</label>
                            <input type="file" name="proof" id="proof" class="mt-1 p-2 w-full border border-red-900 rounded-md bg-white" required>
                        </div>
                        <button type="submit" class="bg-red-700 text-white py-2 px-4 rounded hover:bg-red-800 transition duration-200">Submit Donation</button>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <script>
        function downloadQris() {
            const qrisUrl = '{{ asset('photos/donation.png') }}'; // Update this path as necessary
            const link = document.createElement('a');
            link.href = qrisUrl;
            link.download = 'Qris.jpg'; // Change to .jpg for download
            document.body.appendChild(link); // Append link to body
            link.click(); // Trigger download
            document.body.removeChild(link); // Remove link from body
        }
    </script>
</div>
</x-app-layout>
