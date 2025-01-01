<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::all();
        return view('galleries.all', compact('galleries'));
    }

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->check() && auth()->user()->email === 'admin@gmail.com') {
                $this->isAdmin = true;
            } else {
                $this->isAdmin = false;
            }
            return $next($request);
        });
    }

    public function create()
    {
        if ($this->isAdmin) {
            return redirect()->route('galleries.all')->with('error', 'Admins cannot create galleries.');
        }

        return view('galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:255',
        ]);

        // Simpan gallery
        $imagePath = $request->file('image')->store('galleries', 'public');

        $gallery = new Gallery();
        $gallery->user_id = auth()->id();
        $gallery->image_path = $imagePath;
        $gallery->description = $request->description;
        $gallery->save();

        return redirect()->route('galleries.index')->with('success', 'Gallery added successfully.');
    }


    public function yourGallery()
    {
        if ($this->isAdmin) {
            return redirect()->route('galleries.all')->with('error', 'Admins cannot access Your Gallery.');
        }

        $galleries = Gallery::where('user_id', Auth::id())->get();
        return view('galleries.your', compact('galleries'));
    }

    public function allGallery()
    {
        $galleries = Gallery::all();
        return view('galleries.all', compact('galleries'));
    }

    public function delete($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Admins can delete any gallery, users can delete their own
        if (!$this->isAdmin && $gallery->user_id !== Auth::id()) {
            return redirect()->route('galleries.your')->with('error', 'Unauthorized action.');
        }

        $gallery->delete();
        return redirect()->route('galleries.all')->with('success', 'Gallery item deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        if ($this->isAdmin) {
            return redirect()->route('galleries.all')->with('error', 'Admins cannot update galleries.');
        }

        $gallery = Gallery::where('id', $id)
            ->where('user_id', Auth::id()) // Memastikan pengguna hanya dapat memperbarui item miliknya
            ->firstOrFail();

        // Validasi input
        $validated = $request->validate([
            'description' => 'required|string|max:255', // Deskripsi wajib diisi
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Gambar opsional, hanya menerima format tertentu
        ]);

        // Perbarui deskripsi
        $gallery->description = $validated['description'];

        // Periksa apakah pengguna mengunggah gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($gallery->image_path && \Storage::exists($gallery->image_path)) {
                \Storage::delete($gallery->image_path);
            }

            // Simpan gambar baru
            $path = $request->file('image')->store('gallery_images', 'public');
            $gallery->image_path = $path;
        }

        // Simpan perubahan ke database
        $gallery->save();

        return redirect()->route('galleries.your')->with('success', 'Gallery item updated successfully.');
    }

    public function edit(Request $request, $id)
    {
        if ($this->isAdmin) {
            return redirect()->route('galleries.all')->with('error', 'Admins cannot edit galleries.');
        }

        $gallery = Gallery::where('id', $id)
        ->where('user_id', Auth::id()) // Memastikan pengguna hanya dapat mengedit item miliknya
        ->firstOrFail();

        return view('galleries.edit', compact('gallery'));
    }
}

?>
