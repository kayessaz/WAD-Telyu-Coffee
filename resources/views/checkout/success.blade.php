<!-- resources/views/checkout/success.blade.php -->
<x-app-layout>
    <div class="container mx-auto mt-8 p-8 bg-white rounded-lg shadow-lg text-center">
        <h2 class="text-3xl font-bold mb-6">Pembayaran Berhasil!</h2>

        <p class="text-lg mb-4">Terima kasih sudah memesan, silahkan menunggu...</p>

        <div class="mt-8">
            <a href="{{ route('menu.index') }}" class="text-blue-500 hover:underline">Back to Menu</a>
        </div>
    </div>
</x-app-layout>
