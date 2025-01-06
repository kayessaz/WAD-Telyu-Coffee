<x-app-layout>
    <!-- Countdown Timer -->
    <div class="flex justify-center mt-5">
        <div class="text-center">
            <h2 class="text-xl font-semibold text-gray-800">Payment Countdown</h2>
            <p id="countdown" class="text-lg font-semibold bg-white border-2 border-red-700 text-red-700 py-2 px-4 rounded hover:bg-red-800 hover:text-white transition duration-200 ml-4 flex items-center rounded-full"></p>
        </div>
    </div>

    <div class="flex flex-col md:flex-row mt-5 justify-center pb-40">
        <!-- Left Side: QRIS Image -->
        <div class="flex-shrink-0 mb-8 md:mb-0">
            <img src="{{ asset('photos/qris.png') }}" alt="QRIS" class="w-[550px] h-[550px] object-cover">
        </div>

        <!-- Right Side: Instructions and Buttons -->
        <div class="md:ml-8">
            <h1 class="text-2xl font-bold mb-4 text-red-700">QRIS Payment</h1>
            <p class="mb-4">Scan the QR Code to complete your payment:</p>
            <div class="mb-4">
                <div class="flex items-center mb-4">
                    <button onclick="downloadQris()" class="bg-red-700 text-white py-2 px-4 rounded hover:bg-red-800 transition duration-200 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="mr-2">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4"/>
                        </svg>
                        Download QRIS
                    </button>
                    <form action="{{ route('checkout.completePayment') }}" method="POST" class="ml-4">
                        @csrf
                        <button type="submit" class="bg-white border border-red-700 text-red-700 py-2 px-4 rounded hover:bg-red-800 hover:text-white transition duration-200 flex items-center">
                            Check Payment Status
                        </button>
                    </form>
                </div>
            </div>
            <p class="mb-4">Follow the payment instructions below:</p>
            <ol class="list-decimal list-inside space-y-2">
                <li>Download QR to save image or screen capture QRIS code.</li>
                <li>Open QR payment in your m-banking or E-Wallet.</li>
                <li>Upload the QR Code image or screen capture.</li>
                <li>Check your transaction and make a payment.</li>
                <li>Click Check Payment Status.</li>
            </ol>
        </div>
    </div>

    <script>
        // Countdown Timer
        const countdownElement = document.getElementById('countdown');
        const endTime = new Date().getTime() + 10 * 60 * 1000; // 10 minutes from now

        function updateCountdown() {
            const now = new Date().getTime();
            const timeLeft = endTime - now;

            if (timeLeft > 0) {
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                countdownElement.textContent = `${minutes}m ${seconds}s remaining`;
            } else {
                countdownElement.textContent = "Time is up! Please refresh the page to try again.";
                clearInterval(countdownInterval);
            }
        }

        const countdownInterval = setInterval(updateCountdown, 1000);
        updateCountdown(); // Initial call

        function downloadQris() {
            const qrisUrl = '{{ asset('photos/qris.png') }}'; // Update this path as necessary
            const link = document.createElement('a');
            link.href = qrisUrl;
            link.download = 'Qris.jpg'; // Change to .jpg for download
            document.body.appendChild(link); // Append link to body
            link.click(); // Trigger download
            document.body.removeChild(link); // Remove link from body
        }

        // Function to format numbers as currency
        function formatCurrency(amount) {
            return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(amount);
        }
    </script>
</x-app-layout>
