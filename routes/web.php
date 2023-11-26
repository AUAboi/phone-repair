<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::get('/', [PublicController::class, 'home'])->name('public.home');
Route::get('/contact-us', [PublicController::class, 'contact'])->name('public.contact');
Route::get('/phone/repairs', [PublicController::class, 'repairs'])->name('public.repairs');
Route::get('/all-repairs/{brand}', [PublicController::class, 'repairBrand'])->name('public.repairs.brand');
Route::get('/all-products', [PublicController::class, 'products'])->name('public.products');
Route::get('/book-appointment/repair/{device}', [AppointmentController::class, 'create'])->name('public.appointments.create');
Route::post('/book-appointment/repair/{device}', [AppointmentController::class, 'store'])->name('public.appointments.store');

Route::get('/book-appointment/product/{product}', [AppointmentController::class, 'createProductAppointment'])->name('public.appointments.product.create');
Route::post('/book-appointment/product/{product}', [AppointmentController::class, 'storeProductAppointment'])->name('public.appointments.product.store');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::post('/cart/remove-item', [CartController::class, 'removeItem'])->name('cart.removeitem');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');


Route::get('tracking/order/{order:order_no}', [OrderController::class, 'show'])->name('order.show');

Route::get('tracking/order/', [PublicController::class, 'tracking'])->name('public.tracking');

Route::post('/order/place', [OrderController::class, 'store'])->name('order.store');

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::get('/blog/search', [PostController::class, 'search'])->name('post.search');

Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('post.show');

Route::get('/{deviceCategory}/brands', [PublicController::class, 'categoryBrands'])->name('public.categoryBrands');

Route::middleware(['auth'])->group(function () {
    Route::get('/user/profile', [UserProfileController::class, 'index'])->name('user.profile');
});

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
