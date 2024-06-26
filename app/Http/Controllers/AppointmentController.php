<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\StoreProductAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\DeviceResource;
use App\Http\Resources\ProductResource;
use App\Models\Appointment;
use App\Models\Device;
use App\Models\Product;
use App\Services\AppointmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

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

        return Redirect::route('public.home')->with('success', 'Appointment registered successfully');
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
}
