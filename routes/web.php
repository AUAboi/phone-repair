<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PublicController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
