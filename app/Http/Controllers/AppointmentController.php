<?php

namespace App\Http\Controllers;

use App\Http\Resources\AppointmentResource;
use App\Http\Resources\DeviceRepairResource;
use App\Http\Resources\DeviceResource;
use App\Models\Appointment;
use App\Models\Device;
use App\Models\DeviceRepair;
use App\Models\Repair;
use App\Services\DeviceService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->all('search');
        $appointments = Appointment::orderBy('appointment_date', 'DESC')
            ->with(['device'])
            ->filter($filters)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Appointments/Index', [
            'appointments' => AppointmentResource::collection($appointments),
            'filters' => $filters
        ]);
    }

    public function show(Appointment $appointment)
    {
        // return new AppointmentResource($appointment->load(['device', 'device.brand', 'user', 'deviceRepair', 'deviceRepair.repair']));
        return Inertia::render('Admin/Appointments/Show', [
            'appointment' => new AppointmentResource($appointment->load(['device', 'device.brand', 'user', 'deviceRepair', 'deviceRepair.repair'])),
        ]);
    }

    public function create(Device $device)
    {

        return Inertia::render('Public/Appointments/Create', [
            'device' => new DeviceResource($device->load(['brand', 'repairs'])),
        ]);
    }
}
