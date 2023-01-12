<?php

namespace App\Http\Controllers;

use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
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
}
