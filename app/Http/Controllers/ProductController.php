<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'all'); // Default 'all'

        // Logika filter berdasarkan kategori
        $menus = Product::when($filter != 'all', function ($query) use ($filter) {
            return $query->where('category', $filter);
        })->get();

        return view('products.index', compact('menus', 'filter'));
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
        // Fetch distinct categories from the products table
        $categories = Product::distinct()->pluck('category');
    
        // Filter products based on selected category
        $filter = $request->input('filter', 'all');
        if ($filter != 'all') {
            $products = Product::where('category', $filter)->get();
        } else {
            $products = Product::all();
        }
    
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function adminshow(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function admincreate()
    {
        // Fetch distinct categories from the products table
        $categories = Product::select('category')->distinct()->pluck('category');

        return view('admin.products.create', compact('categories'));
    }
    public function adminstore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'hot_price' => 'nullable|numeric|min:0',
            'ice_price' => 'nullable|numeric|min:0',
            'image_url' => 'nullable|image|max:2048',
            'category' => 'nullable|string',
            'new_category' => 'nullable|string',
        ]);

        // Determine which category to use (either selected or custom)
        $category = $request->input('new_category') ?: $request->input('category'); // Default to selected category, or use custom if provided

        // Handle image upload
        if ($request->hasFile('image_url')) {
            // Store the new image
            $image = $request->file('image_url');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/products', $imageName);
            $imageUrl = Storage::url($imagePath);  // Get the URL for public access
        } else {
            $imageUrl = null;  // Set to null if no image is uploaded
        }

        // Create the product with the stored image URL
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'hot_price' => $request->hot_price,
            'ice_price' => $request->ice_price,
            'image_url' => $imageUrl,
            'category' => $category,  // Use the selected or new category
        ]);

        return redirect()->route('admin.products.index');
    }

    public function adminedit($id)
    {
        // Fetch distinct categories from the products table
        $categories = Product::select('category')->distinct()->pluck('category');
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function adminupdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'hot_price' => 'nullable|numeric',
            'ice_price' => 'nullable|numeric',
            'image_url' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'category' => 'nullable|string', // Add validation for category
            'new_category' => 'nullable|string', // Validation for new category input
        ]);

        $product = Product::findOrFail($id);

        // Handle category update
        $category = $request->category;
        if ($category === 'Other') {
            $category = $request->new_category;  // Use the new category if "Other" is selected
        }

        // Handle image upload if file is provided
        if ($request->hasFile('image_url')) {
            // Delete old image if exists
            if ($product->image_url) {
                $oldImage = public_path($product->image_url);
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }

            $image = $request->file('image_url');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/products', $imageName);
            $imageUrl = Storage::url($imagePath);  // Get the URL for public access
        } else {
            $imageUrl = $product->image_url;  // Keep the old image URL if no new file is uploaded
        }

        // Update product details
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'hot_price' => $request->hot_price,
            'ice_price' => $request->ice_price,
            'category' => $category,  // Update the category
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('admin.products.index');
    }


    public function admindestroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
