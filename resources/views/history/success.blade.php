<x-app-layout>
    <div class="bg-white min-h-screen">
        <!-- Checkout Success Header -->
        <div class="flex justify-between items-center p-6">
            <button id="download-pdf" class="bg-red-700 text-white py-2 px-4 rounded hover:bg-red-800 transition duration-200 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="mr-2">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 15v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-8 1V4m0 12-4-4m4 4 4-4"/>
                </svg>
                <span>Download Receipt</span>
            </button>
        </div>

        <!-- Order Information Container -->
        <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg mt-10 mb-30 pb-30" id="receipt">
            <!-- Header -->
            <div class="text-center mb-6">
                <img src="{{ asset('photos/logo telyucoffee fix.png') }}" alt="Tel-U Coffee Logo" class="mx-auto mb-4 w-24 h-24">
            </div>

            <!-- Order Information -->
            <div class="mb-6">
                <div class="text-sm text-gray-700">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Order ID:</span>
                        <span>{{ $history->id }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Customer Name:</span>
                        <span>{{ $history->user->name }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Payment Method:</span>
                        <span>{{ $history->payment_method }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Date:</span>
                        <span>{{ $history->created_at }}</span>
                    </div>
                </div>

                <hr class="my-4 border-gray-300">

                <!-- Price Summary -->
                <div class="space-y-2">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Price Summary</h3>
                    <div class="flex justify-between">
                        <span>Total Bill:</span>
                        <span>Rp{{ number_format($history->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Tax 12%:</span>
                        <span>Rp{{ number_format($history->total_price * 0.12, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between font-semibold text-xl">
                        <span>Grand Total:</span>
                        <span>Rp{{ number_format($history->total_price + ($history->total_price * 0.12), 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include html2pdf.js library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

    <script>
        document.getElementById('download-pdf').addEventListener('click', function() {
            var element = document.getElementById('receipt');

            // Menggunakan html2pdf untuk mengonversi elemen HTML menjadi PDF
            html2pdf()
                .from(element)  // Tentukan elemen yang ingin diprint
                .save('receipt.pdf');  // Simpan sebagai file PDF
        });
    </script>
</x-app-layout>
