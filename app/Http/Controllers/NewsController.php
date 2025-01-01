<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();
        return view('news.index', compact('news'));
    }

    public function show($id)
    {
        // Ambil berita berdasarkan ID
        $newsItem = News::findOrFail($id);

        // Kirim data berita ke tampilan
        return view('news.show', compact('newsItem'));
    }

    // Menampilkan form untuk menambah berita
    public function create()
    {
        return view('news.create');
    }

    // Menyimpan berita yang ditambahkan
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'upload_date' => 'required|date',
        ]);

        // Menyimpan gambar
        $imagePath = $request->file('image')->store('news_images', 'public');

        // Menyimpan data berita ke database
        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'upload_date' => $request->upload_date,
        ]);

        return redirect()->route('news.index')->with('success', 'News added successfully!');
    }

    public function edit($id)
    {
        $newsItem = News::findOrFail($id);

        // Pastikan hanya admin yang bisa mengakses halaman edit
        if (auth()->user()->email != 'admin@gmail.com') {
            return redirect()->route('news.index')->with('error', 'You do not have permission to edit this news.');
        }

        return view('news.edit', compact('newsItem'));
    }

    // Memperbarui berita
    public function update(Request $request, $id)
    {
        // Pastikan hanya admin yang bisa mengupdate berita
        if (auth()->user()->email != 'admin@gmail.com') {
            return redirect()->route('news.index')->with('error', 'You do not have permission to update this news.');
        }

        $newsItem = News::findOrFail($id);

        // Validasi input
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // Update data berita
        $newsItem->title = $request->title;
        $newsItem->content = $request->content;

        // Menyimpan data yang telah diperbarui
        $newsItem->save();

        return redirect()->route('news.index')->with('success', 'News updated successfully!');
    }

    // Menghapus berita
    public function destroy($id)
    {
        // Pastikan hanya admin yang bisa menghapus berita
        if (auth()->user()->email != 'admin@gmail.com') {
            return redirect()->route('news.index')->with('error', 'You do not have permission to delete this news.');
        }

        $newsItem = News::findOrFail($id);
        $newsItem->delete();

        return redirect()->route('news.index')->with('success', 'News deleted successfully!');
    }
}
