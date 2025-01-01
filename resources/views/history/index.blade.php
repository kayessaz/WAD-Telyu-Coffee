<x-app-layout>
    <div class="bg-white min-h-screen">
        <h1 class="text-3xl font-bold mb-5">
            @if(auth()->user()->email == 'admin@gmail.com')
                All Purchase Histories
            @else
                Your Purchase History
            @endif
        </h1>

        @if(count($histories) > 0)
            @if(auth()->user()->email == 'admin@gmail.com')
                <!-- Admin View (Table) -->
                <table class="table-auto w-full border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100 text-gray-900">
                            <th class="border px-4 py-2">ID</th>
                            <th class="border px-4 py-2">Customer Name</th>
                            <th class="border px-4 py-2">Category</th>
                            <th class="border px-4 py-2">Product Name</th>
                            <th class="border px-4 py-2">Quantity</th>
                            <th class="border px-4 py-2">Total Price</th>
                            <th class="border px-4 py-2">Payment Method</th>
                            <th class="border px-4 py-2">Date Ordered</th>
                            <th class="border px-4 py-2">Tax (12%)</th>
                            <th class="border px-4 py-2">Grand Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($histories as $history)
                            @php
                                $tax = $history->total_price * 0.12;
                                $grand_total = $history->total_price + $tax;
                                $payment_method = ucfirst($history->payment_method);
                            @endphp
                            <tr>
                                <td class="border px-4 py-2">{{ $history->id }}</td>
                                <td class="border px-4 py-2">{{ $history->user->name }}</td>
                                <td class="border px-4 py-2">{{ $history->category }}</td>
                                <td class="border px-4 py-2">{{ $history->product_name }}</td> <!-- Updated to retrieve product name -->
                                <td class="border px-4 py-2">{{ $history->quantity }}</td>
                                <td class="border px-4 py-2">Rp{{ number_format($history->total_price, 0, ',', '.') }}</td>
                                <td class="border px-4 py-2">{{ $payment_method }}</td>
                                <td class="border px-4 py-2">{{ $history->created_at->format('d M Y') }}</td>
                                <td class="border px-4 py-2">Rp{{ number_format($tax, 0, ',', '.') }}</td>
                                <td class="border px-4 py-2">Rp{{ number_format($grand_total, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <!-- User View (Card) -->
                @if($histories->isNotEmpty())
                    <!-- User View (Card Layout) -->
                    <div class="space-y-6">
                        @php
                            // Group histories by date
                            $groupedHistories = $histories->groupBy(function($date) {
                                return \Carbon\Carbon::parse($date->created_at)->format('d M Y');
                            });
                        @endphp

                        @foreach($groupedHistories as $date => $historyGroup)
                            <div>
                                <h2 class="text-xl font-semibold mb-4">{{ $date }}</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @foreach($historyGroup as $history)
                                        @php
                                            $tax = $history->total_price * 0.12;
                                            $grand_total = $history->total_price + $tax;
                                            $payment_method = ucfirst($history->payment_method);
                                        @endphp
                                        <div class="bg-white shadow-md rounded-lg p-6">
                                            <div class="flex justify-between items-center mb-4">
                                                <h3 class="text-lg font-semibold">Order ID: {{ $history-> id }}</h3>
                                                <p class="text-gray-500">{{ $history->created_at->format('d M Y') }}</p>
                                            </div>

                                            <div class="flex items-center mb-4">
                                                <img src="{{ $history->image_url }}" alt="{{ $history->product->name ?? 'Product Image' }}" class="w-24 h-24 object-cover rounded-md mr-4">
                                                <div>
                                                    <p class="text-red-700">{{ $history->category }}</p>
                                                    <p class="font-semibold text-gray-900">{{ $history->product_name }}</p> <!-- Updated to retrieve product name -->
                                                    <p class="text-gray-700">{{ $history->temperature === 'hot' ? 'Hot' : 'Ice' }}</p>
                                                </div>
                                            </div>

                                            <div class="flex justify-between mb-4">
                                                <p class="text-gray-600">Quantity:</p>
                                                <p class="font-semibold">{{ $history->quantity }}</p>
                                            </div>

                                            <div class="mt-4 border-t pt-4">
                                                <div class="flex justify-between">
                                                    <p class="text-red-700 font-semibold">Total Price:</p>
                                                    <p class="font-semibold">Rp{{ number_format($history->total_price, 0, ',', '.') }}</p>
                                                </div>
                                                <div class="flex justify-between">
                                                    <p class="text-red-700">Tax (12%):</p>
                                                    <p class="font-semibold">Rp{{ number_format($tax, 0, ',', '.') }}</p>
                                                </div>
                                                <div class="flex justify-between">
                                                    <p class="text-red-900 font-bold">Grand Total:</p>
                                                    <p class="text-red-900 font-bold">Rp{{ number_format($grand_total, 0, ',', '.') }}</p>
                                                </div>
                                            </div>

                                            <div class="mt-4 text-sm text-white bg-red-700 bg-opacity-70 p-2 flex justify-between rounded-md">
                                                <p>Payment Method:</p>
                                                <p> {{ $payment_method }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>No purchase history available.</p>
                @endif
            @endif
        @else
            <p>No history records found.</p>
        @endif
    </div>
</x-app-layout>
