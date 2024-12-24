<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    // Rute untuk membuat review (hanya untuk pengguna login)
    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews/create', [ReviewController::class, 'store'])->name('reviews.store');

    // Rute untuk menampilkan review milik pengguna
    Route::get('/reviews/your-review', [ReviewController::class, 'yourReview'])->name('reviews.yourReview');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/menu',[ProductController::class, 'index'])->name('menu.index');
Route::get('/menu/add',[ProductController::class, 'add'])->name('menu.add');
Route::post('/menu/store',[ProductController::class, 'store'])->name('menu.store');
Route::delete('/menu/delete/{id}', [ProductController::class, 'destroy'])->name('menu.destroy');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update/{id}', [CartController::class, 'updateCartItem'])->name('cart.update');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('Products.show');


Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');

Route::get('/history', [HistoryController::class, 'index'])->name('history.index');

Route::resource('reviews', ReviewController::class);
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/reviews/create', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/reviews/your-review', [ReviewController::class, 'yourReview'])->name('reviews.yourReview');
Route::get('/reviews/all', [ReviewController::class, 'allReviews'])->name('reviews.allReview');
Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('reviews.update');
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/galleries', [GalleryController::class, 'index'])->name('galleries.index');
    Route::get('/galleries/create', [GalleryController::class, 'create'])->name('galleries.create');
    Route::post('/galleries', [GalleryController::class, 'store'])->name('galleries.store');
    Route::get('/galleries/your', [GalleryController::class, 'yourGallery'])->name('galleries.your');
    Route::get('/galleries/all', [GalleryController::class, 'allGallery'])->name('galleries.all');
    Route::get('/galleries/{id}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
    Route::delete('/galleries/your/{id}', [GalleryController::class, 'delete'])->name('galleries.delete');
    Route::put('/galleries/your/{id}', [GalleryController::class, 'update'])->name('galleries.update');
});

