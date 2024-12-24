<x-app-layout>
    <x-slot name="header">
    <div class="container-fluid mt-10 sm:mx-auto sm:w-full sm:max-w-sm text-gray-900">
        <h1 class="block text-lg font-medium leading-6 text-gray-900 mb-5">Riwayat Pembelian Anda : </h1>

        @if(count($histories) > 0)
            <table class="table">
                <thead>
                    <tr class="text-gray-900">
                        <th>ID</th>
                        <th>Nama Produk</th>
                        <th>Quantity</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Date Ordered</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($histories as $history)
                        <tr>
                            <td>{{ $history->id }}</td>
                            <td>{{ $history->product->name }}</td>
                            <td>{{ $history->quantity }}</td>
                            <td>{{ $history->total_price }}</td>
                            <td>{{ $history->status }}</td>
                            <td>{{ $history->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="block text-sm font-medium leading-6 text-gray-900 mb-5">Belum ada Riwayat Pembelian</p>
        @endif
    </div>
</x-slot>
</x-app-layout>
