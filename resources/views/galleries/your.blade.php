<x-app-layout>
    <div class="bg-white min-h-screen">
        <!-- Container untuk konten -->
        <div class="container mx-auto p-6">
            @if(Auth::user()->email === 'admin@gmail.com')
                <p>Admins cannot access Your Gallery.</p>
            @else
                <a href="{{ route('galleries.create') }}" class="btn btn-primary btn-small mb-4">Add Gallery</a>
                <h1 class="text-3xl font-bold mb-5">Your Gallery</h1>
                @if($galleries->isEmpty())
                    <p class="text-gray-600">You don’t have any gallery items yet.</p>
                @else
                    <!-- Grid untuk menampilkan galeri -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 ">
                        @foreach($galleries as $gallery)
                            <div class="bg-white p-4 rounded shadow-lg ">
                                <!-- Gambar -->
                                <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="Gallery Image" class="w-full h-auto rounded-md">

                                <!-- Deskripsi -->
                                <p class="mt-2">{{ $gallery->description }}</p>
                                <small class="text-gray-500">Uploaded by {{ $gallery->user->name }} on {{ $gallery->created_at->format('d M Y') }}</small>

                                <!-- Tombol Edit dan Hapus Galeri -->
                                <div class="gallery-buttons flex gap-2 mt-4">
                                    @if(auth()->user()->id == $gallery->user_id || auth()->user()->email == 'admin@gmail.com')
                                        <a href="{{ route('galleries.edit', $gallery->id) }}" class="btn btn-primary btn-small">Edit Gallery</a>
                                    @endif

                                    @if(auth()->user()->id == $gallery->user_id || auth()->user()->email == 'admin@gmail.com')
                                        <form action="{{ route('galleries.delete', $gallery->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete btn-small">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>
