<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeviceRepairController;
use App\Http\Controllers\ProductController;

Route::middleware(['auth', 'admin'])->group(function () {
  // Route::get('/dashboard', function () {
  //   return Inertia::render('Admin/Dashboard');
  // })->name('dashboard');

  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
  Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
  Route::post('/brands/create', [BrandController::class, 'store'])->name('brands.store');
  Route::get('/brands/{brand}', [BrandController::class, 'edit'])->name('brands.edit');
  Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
  Route::delete('/brands/{brand}/delete', [BrandController::class, 'destroy'])->name('brands.destroy');

  Route::get('/devices', [DeviceController::class, 'index'])->name('devices.index');
  Route::get('/devices/create', [DeviceController::class, 'create'])->name('devices.create');
  Route::post('/devices/create', [DeviceController::class, 'store'])->name('devices.store');
  Route::get('/devices/{device}', [DeviceController::class, 'edit'])->name('devices.edit');
  Route::put('/devices/{device}', [DeviceController::class, 'update'])->name('devices.update');
  Route::delete('/devices/{device}/delete', [DeviceController::class, 'destroy'])->name('devices.destroy');

  Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
  Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
  Route::post('/categories/create', [CategoryController::class, 'store'])->name('categories.store');
  Route::get('/categories/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
  Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
  Route::delete('/categories/{category}/delete', [CategoryController::class, 'destroy'])->name('categories.destroy');

  Route::get('/products', [ProductController::class, 'index'])->name('products.index');
  Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
  Route::post('/products/create', [ProductController::class, 'store'])->name('products.store');
  Route::get('/products/{product}', [ProductController::class, 'edit'])->name('products.edit');
  Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
  Route::delete('/products/{product}/delete', [ProductController::class, 'destroy'])->name('products.destroy');

  Route::get('/repairs', [RepairController::class, 'index'])->name('repairs.index');
  Route::get('/repairs/create', [RepairController::class, 'create'])->name('repairs.create');
  Route::post('/repairs/create', [RepairController::class, 'store'])->name('repairs.store');
  Route::get('/repairs/{repair}', [RepairController::class, 'edit'])->name('repairs.edit');
  Route::put('/repairs/{repair}', [RepairController::class, 'update'])->name('repairs.update');
  Route::delete('/repairs/{repair}/delete', [RepairController::class, 'destroy'])->name('repairs.destroy');

  Route::get('/repairs/{device}/add', [DeviceRepairController::class, 'create'])->name('device.repair.create');
  Route::post('/repairs/{device}/add', [DeviceRepairController::class, 'store'])->name('device.repair.store');
  Route::get('/repairs/{deviceRepair}/edit', [DeviceRepairController::class, 'edit'])->name('device.repair.edit');
  Route::put('/repairs/{deviceRepair}/edit', [DeviceRepairController::class, 'update'])->name('device.repair.update');
  Route::delete('/repairs/{deviceRepair}/remove', [DeviceRepairController::class, 'destroy'])->name('device.repair.destroy');

  Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
  Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');

  Route::get('/users', [UserController::class, 'index'])->name('users.index');
});
