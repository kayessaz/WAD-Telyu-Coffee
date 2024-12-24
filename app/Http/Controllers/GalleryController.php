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
        return view('galleries.index', compact('galleries'));
    }

    public function create()
{
    return view('galleries.create');
}

public function store(Request $request)
    {
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'description' => 'nullable|string|max:255',
    ]);

    $imagePath = $request->file('image')->store('gallery_images', 'public');

    $gallery = new Gallery();
    $gallery->user_id = Auth::id();
    $gallery->image_path = $imagePath;
    $gallery->description = $request->description;
    $gallery->save();

    return redirect()->route('galleries.your')->with('success', 'Gallery item created successfully!');
    }


    public function yourGallery()
    {
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
        $gallery = Gallery::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $gallery->delete();
        return redirect()->route('galleries.your')->with('success', 'Gallery item deleted successfully.');
    }

    public function update(Request $request, $id)
    {
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
        $gallery = Gallery::where('id', $id)
        ->where('user_id', Auth::id()) // Memastikan pengguna hanya dapat mengedit item miliknya
        ->firstOrFail();

        return view('galleries.edit', compact('gallery'));
    }
}

?>
