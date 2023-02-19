<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceRepairController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RepairController;
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
Route::get('/phone/repairs', [PublicController::class, 'repairs'])->name('public.repairs');
Route::get('/all-repairs/{brand}', [PublicController::class, 'repairBrand'])->name('public.repairs.brand');

Route::get('/book-appointment/{device}', [AppointmentController::class, 'create'])->name('public.appointments.create');
Route::post('/book-appointment/{device}', [AppointmentController::class, 'store'])->name('public.appointments.store');

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
