<?php

use Stripe\Stripe;
use Inertia\Inertia;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AppointmentController;
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
Route::get('/shop', [PublicController::class, 'shop'])->name('public.shop');
Route::get('/contact-us', [PublicController::class, 'contact'])->name('public.contact');
Route::get('/about-us', [PublicController::class, 'about'])->name('public.about');
Route::get('/book-a-repair', [PublicController::class, 'repairs'])->name('public.repairs');
Route::get('/book-a-repair/{brand}', [PublicController::class, 'repairBrand'])->name('public.repairs.brand');
Route::get('/all-products', [PublicController::class, 'products'])->name('public.products');
Route::get('/terms-and-conditions', [PublicController::class, 'terms'])->name('public.terms');

Route::get('/category/{category}/products', [PublicController::class, 'categoryProducts'])->name('public.categoryProducts');

Route::get('/product-details/{product}', [PublicController::class, 'product'])->name('public.product.show');

Route::get('/book-appointment/repair/{device}', [AppointmentController::class, 'create'])->name('public.appointments.create');
Route::post('/book-appointment/repair/{device}', [AppointmentController::class, 'store'])->name('public.appointments.store');

Route::get('/book-appointment/product/{product}', [AppointmentController::class, 'createProductAppointment'])->name('public.appointments.product.create');
Route::post('/book-appointment/product/{product}', [AppointmentController::class, 'storeProductAppointment'])->name('public.appointments.product.store');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

Route::post('/cart/remove-item', [CartController::class, 'removeItem'])->name('cart.removeitem');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

Route::get('/tracking/order/{order:order_no}', [OrderController::class, 'show'])->name('order.show');
Route::get('/tracking/appointment/{appointment:appointment_number}', [AppointmentController::class, 'showAppointment'])->name('appointment.show');

Route::get('/tracking/order', [PublicController::class, 'orderTracking'])->name('public.order.tracking');
Route::get('/tracking/appointment', [PublicController::class, 'appointmentTracking'])->name('public.appointment.tracking');

Route::get('/payment/appointment/{appointment:appointment_number}', [AppointmentController::class, 'paymentPage'])->name('appointment.paymentPage');
Route::post('/payment/appointment/{appointment:appointment_number}', [AppointmentController::class, 'paymentHandle'])->name('appointment.paymentHandle');

Route::post('/order/place', [OrderController::class, 'store'])->name('order.store');

Route::get('/order/complete', function (Request $request) {
    Stripe::setApiKey(env('STRIPE_SECRET'));


    $paymentIntent = PaymentIntent::retrieve($request->payment_intent);

    if ($paymentIntent->status === 'succeeded') {
        // \App\Models\Order::where('payment_intent_id', $paymentIntent->id)->update([
        //     'status' => 'paid',
        // ]);
        return redirect()->route('public.order.tracking')->with('success', 'Payment successful!');
    }

    return redirect()->route('public.home')->with('error', 'Payment failed or pending.');
})->name('order.complete');


Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::get('/blogs', [PostController::class, 'public'])->name('public.posts');

Route::get('/blog/search', [PostController::class, 'search'])->name('post.search');

Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('post.show');

Route::get('/category/{deviceCategory}/brands', [PublicController::class, 'categoryBrands'])->name('public.categoryBrands');

Route::middleware(['auth'])->group(function () {
    Route::get('/user/profile', [UserProfileController::class, 'index'])->name('user.profile');
});

Route::get('/app/migrate/test', function () {
    Artisan::call('migrate:fresh', ['--force' => true, '--seed' => true]);
    return 'Database migrated and seeded successfully!';
});


Route::get('/sym', function () {
    Artisan::call('storage:link');
});

Route::get('/maintenance-on', function () {
    Artisan::call('down', [
        '--secret' => 'my-secret-key' // Optional: Allows access with a secret URL
    ]);
    return 'Application is now in maintenance mode!';
});

Route::get('/maintenance-off', function () {
    Artisan::call('up');
    return 'Application is now live!';
});

Route::get('/backup-full', function () {
    // Run the backup command
    Artisan::call('backup:run');
    $migrationOutput = Artisan::output();

    // Define the backup storage path
    $backupPath = 'Fonemart'; // storage/app/Fonemart

    // Get the most recent backup file
    $files = collect(Storage::files($backupPath))
        ->filter(fn($file) => str_ends_with($file, '.zip')) // Only ZIP files
        ->sortByDesc(fn($file) => Storage::lastModified($file));

    if ($files->isEmpty()) {
        return response()->json([
            'message' => 'Backup completed, but no ZIP backup file was found.',
            'migration_output' => $migrationOutput,
        ], 404);
    }

    $latestBackup = $files->first();
    $filePath = storage_path("app/{$latestBackup}");

    // Return the latest backup file as a download
    return response()->download($filePath);
});


Route::post('/stripe/webhook', '\Spatie\StripeWebhooks\StripeWebhooksController')->name('stripe.webhook');

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
