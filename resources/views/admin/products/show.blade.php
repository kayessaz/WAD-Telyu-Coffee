<x-app-layout>
    <div class="space-y-4 pb-8">
        <h3 class="text-2xl font-medium">{{ $product->name }}</h3>
        <p>{{ $product->description }}</p>
        <p>Hot Price: ${{ $product->hot_price }}</p>
        <p>Ice Price: ${{ $product->ice_price }}</p>
        @if ($product->image_url)
            <img src="{{ asset($product->image_url) }}" alt="Product Image" class="mt-4 w-48">
        @endif
    </div>
</x-app-layout>
