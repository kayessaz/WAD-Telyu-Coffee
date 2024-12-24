<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-5">Your Gallery</h1>

        <a href="{{ route('galleries.create')}}" class="btn btn-primary btn-small">Add Gallery</a>


        @if($galleries->isEmpty())
            <p>You don’t have any gallery items yet.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($galleries as $gallery)
                    <div class="bg-white p-4 rounded shadow">
                        <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="Image" class="w-full h-auto">
                        <p class="mt-2">{{ $gallery->description }}</p>
                        <div class="gallery-buttons">
                            <a href="{{ route('galleries.edit', $gallery->id) }}" class="btn btn-primary btn-small">Edit Gallery</a>
                            <form action="{{ route('galleries.delete', $gallery->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete btn-small">Delete</button>
                            </form>

                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
