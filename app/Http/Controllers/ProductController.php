<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
    {

        public function index(Request $request)
        {
            $category = $request->input('category');

            // Jika kategori dipilih, filter produk berdasarkan kategori
            if ($category) {
                $products = Product::where('category', $category)->get();
            } else {
                // Jika tidak ada kategori yang dipilih, ambil semua produk
                $products = Product::all();
            }

            // Kirim produk ke view
            return view('products.index', compact('products'));
        }

        public function show($id)
        {
            $product = Product::find($id);
            if(is_null($product)){
                return redirect()->route('menu.index')->with('error', 'Product is empty');
            }
            return view('products.show', compact('product'));
        }

        public function add()
        {
            if (auth()->check() && auth()->user()->email == 'admin@gmail.com') {
                return view('products.add');
            } else {
                return redirect()->route('menu.index');
            }
        }

        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric',
                'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ]);

            if ($request->hasFile('images')) {
                $imagePath = $request->file('images')->store('product_images', 'public');
                $validatedData['image_url'] = 'storage/' . $imagePath;
            }

            Product::create($validatedData);

            return redirect()->route('menu.index')->with('success', 'Product added successfully');
        }

        public function destroy($id)
        {
            $product = Product::findOrFail($id);
            if ($product->image_url) {
                Storage::disk('public')->delete(str_replace('storage/', '', $product->image_url));
            }

            $product->delete();

            return redirect()->route('menu.index')->with('success', 'Product deleted successfully!');
        }

        public function adminindex(Request $request)
        {
            // Ambil kategori yang dipilih dari parameter request
            $category = $request->input('category');

            // Jika kategori dipilih, filter produk berdasarkan kategori
            if ($category) {
                $products = Product::where('category', $category)->get();
            } else {
                // Jika tidak ada kategori yang dipilih, ambil semua produk
                $products = Product::all();
            }

            // Kirim produk ke view
            return view('admin.products.index', compact('products'));
        }

        public function adminshow($id)
        {
            $product = Product::find($id);
            if(is_null($product)){
                return redirect()->route('menu.index')->with('error', 'Product is empty');
            }
            return view('admin.products.show', compact('product'));
        }

        // Menampilkan form untuk menambah produk
        public function admincreate()
        {
            $categories = ['Non-Coffee', 'Espresso Based', 'Manual Brew', 'Bottle 1L', 'Food'];
            return view('admin.products.create', compact('categories'));
        }

        // Menyimpan data produk baru
        public function adminstore(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'category' => 'required|in:Non-Coffee,Espresso Based,Manual Brew,Bottle 1L,Food',
                'price' => 'nullable|numeric|required_if:category,Food,Bottle 1L',
                'hot_price' => 'nullable|numeric|required_if:category,Non-Coffee,Espresso Based,Manual Brew',
                'ice_price' => 'nullable|numeric|required_if:category,Non-Coffee,Espresso Based,Manual Brew',
                'image_url' => 'nullable|image|max:2048',
            ]);

            // Handle image upload
            if ($request->hasFile('image_url')) {
                $image = $request->file('image_url');
                $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('public/products', $imageName);
                $imageUrl = Storage::url($imagePath);
            } else {
                $imageUrl = null;
            }

            // Menyimpan produk baru
            Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'category' => $request->category,
                'price' => in_array($request->category, ['Bottle 1L', 'Food']) ? $request->price : null,
                'hot_price' => in_array($request->category, ['Espresso Based', 'Manual Brew', 'Non-Coffee']) ? $request->hot_price : null,
                'ice_price' => in_array($request->category, ['Espresso Based', 'Manual Brew', 'Non-Coffee']) ? $request->ice_price : null,
                'image_url' => $imageUrl,
            ]);

            return redirect()->route('admin.products.index');
        }

        // Menampilkan form untuk mengedit produk
        public function adminedit(Product $product)
        {
            $categories = [
                ["name" => "Non-Coffee"],
                ["name" => "Espresso Based"],
                ["name" => "Manual Brew"],
                ["name" => "Bottle 1L"],
                ["name" => "Food"],
              ];

            return view('admin.products.edit', compact('product', 'categories'));
        }

        // Menyimpan perubahan produk
        public function adminupdate(Request $request, Product $product)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'category' => 'required|in:Non-Coffee,Espresso Based,Manual Brew,Bottle 1L,Food',
                'price' => 'nullable|numeric|required_if:category,Food',
                'hot_price' => 'nullable|numeric|required_if:category,Espresso Based,Manual Brew',
                'ice_price' => 'nullable|numeric|required_if:category,Espresso Based,Manual Brew',
                'image_url' => 'nullable|image|max:2048',
            ]);

            // Handle image upload
            if ($request->hasFile('image_url')) {
                $image = $request->file('image_url');
                $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('public/products', $imageName);
                $imageUrl = Storage::url($imagePath);
            } else {
                $imageUrl = $product->image_url;
            }

            // Menyimpan perubahan produk
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'category' => $request->category,
                'price' => in_array($request->category, ['Bottle 1L', 'Food']) ? $request->price : null,
                'hot_price' => in_array($request->category, ['Espresso Based', 'Manual Brew', 'Non-Coffee']) ? $request->hot_price : null,
                'ice_price' => in_array($request->category, ['Espresso Based', 'Manual Brew', 'Non-Coffee']) ? $request->ice_price : null,
                'image_url' => $imageUrl,
            ]);

            return redirect()->route('admin.products.index');
        }

        // Menghapus produk
        public function admindestroy(Product $product)
        {
            $product->delete();
            return redirect()->route('admin.products.index');
        }
    }
