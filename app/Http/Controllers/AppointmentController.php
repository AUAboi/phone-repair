<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Inertia\Inertia;
use App\Models\Device;
use App\Models\Product;
use Stripe\PaymentIntent;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Services\AppointmentService;
use App\Http\Resources\DeviceResource;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Resources\AppointmentResource;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\StoreProductAppointmentRequest;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->all('search', 'status');
        $appointments = Appointment::orderBy('appointment_date', 'DESC')
            ->with(['device'])
            ->filter($filters)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Appointments/Index', [
            'appointments' => AppointmentResource::collection($appointments),
            'statuses' => config('constants.statuses'),
            'filters' => $filters
        ]);
    }

    public function show(Appointment $appointment)
    {
        return Inertia::render('Admin/Appointments/Show', [
            'appointment' => new AppointmentResource($appointment->load(['device', 'device.brand', 'user', 'deviceRepair', 'deviceRepair.repair'])),
        ]);
    }

    public function showAppointment(Appointment $appointment)
    {
        return Inertia::render('Public/Appointments/Show', [
            'appointment' => new AppointmentResource($appointment->load(['device', 'device.brand', 'user', 'deviceRepair', 'deviceRepair.repair'])),
        ]);
    }

    public function create(Device $device)
    {
        if (!$device->repairs()->count()) {
            return redirect()->back()->with('error', 'Repair not available');
        }

        return Inertia::render('Public/Appointments/Create', [
            'device' => new DeviceResource($device->load(['brand', 'repairs'])),
        ]);
    }

    public function store(Device $device,  StoreAppointmentRequest $request, AppointmentService $appointmentService)
    {
        try {
            $appointment = $appointmentService->createAppointment($device, $request->validated(), $request->user() ?? null);
        } catch (\Throwable $th) {
            return redirect()->route('public.repairs')->with('error', $th->getMessage());
        }

        return Redirect::route('appointment.show', $appointment->appointment_number);
    }

    public function createProductAppointment(Product $product)
    {
        return Inertia::render('Public/Appointments/ProductAppointment', [
            'product' => new ProductResource($product->load(['category'])),
        ]);
    }

    public function storeProductAppointment(Product $product, StoreProductAppointmentRequest  $request,  AppointmentService $appointmentService)
    {
        try {
            $appointmentService->createProductAppointment($product, $request->validated(), $request->user() ?? null);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

        return Redirect::route('public.home')->with('success', 'Appointment registered successfully');
    }

    public function paymentPage(Appointment $appointment)
    {
        if ($appointment->payment_status === 'paid') {
            return redirect()->back()->with('error', 'Paid already');
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentIntentId = Session::get('appointment_payment_intent_id');
        $paymentIntent = null;

        if ($paymentIntentId) {
            try {
                $paymentIntent = PaymentIntent::retrieve($paymentIntentId);


                // If the PaymentIntent exists and is still modifiable, update it
                if ($paymentIntent->status === 'requires_payment_method' && $paymentIntent->amount !== (int)$appointment->total * 100) {
                    PaymentIntent::update($paymentIntent->id, ['amount' => $appointment->total * 100]);
                }
            } catch (\Exception $e) {
                // If PaymentIntent retrieval fails, create a new one
                $paymentIntent = null;
            }
        }

        // If PaymentIntent does not exist or cannot be updated, create a new one
        if (!$paymentIntent || $paymentIntent->status !== 'requires_payment_method') {
            $paymentIntent = PaymentIntent::create([
                'amount' => $appointment->total * 100,
                'currency' => config('constants.currency'),
                'payment_method_types' => ['card', 'paypal', 'klarna'],
            ]);

            // Store new PaymentIntent ID
            Session::put('appointment_payment_intent_id', $paymentIntent->id);
        }

        return Inertia::render('Public/Appointments/Payment', [
            'appointment' => new AppointmentResource($appointment),
            'clientSecret' => $paymentIntent->client_secret,
            'stripeKey' => env('VITE_STRIPE_PUBLIC_KEY'),
            'paymentIntentId' => $paymentIntent->id
        ]);
    }

    public function paymentHandle(Request $request, Appointment $appointment)
    {
        if ($appointment->payment_status === 'paid') {
            return redirect()->back()->with('error', 'Paid already');
        }

        $request->validate([
            'paymentIntentId' => 'required',
            'paymentMethodId' => 'required'
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = PaymentIntent::retrieve($request->paymentIntentId);


            // Update the payment intent with metadata
            PaymentIntent::update($request->paymentIntentId, [
                'metadata' => ['appointment_id' => $appointment->appointment_number, 'type' => 'appointment'],
            ]);


            //Make sure payment intent total matches order total
            if ($paymentIntent->amount !== (int)$appointment->total * 100) {
                return redirect()->route('appointment.show',  $appointment->appointment_number)->with('error', 'Payment failed. Please try again.');
            }

            // Make sure return url has payment intent id
            $paymentIntent->confirm([
                'payment_method' => $request->paymentMethodId,
                'return_url' => route('appointment.show',  $appointment->appointment_number),
            ]);

            if ($paymentIntent->status === 'requires_action' && isset($paymentIntent->next_action->redirect_to_url)) {
                return Inertia::location($paymentIntent->next_action->redirect_to_url->url); // Redirect to PayPal
            }
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return redirect()->route('appointment.show',  $appointment->appointment_number)->with('error', 'Stripe error: ' . $e->getMessage());
        } catch (\Throwable $th) {
            return redirect()->route('appointment.show',  $appointment->appointment_number)->with('error', 'Payment failed. Please try again.');
        }

        return redirect()->route('appointment.show', $appointment->appointment_number);
    }
}
