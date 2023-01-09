<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Device;
use App\Models\Repair;
use Illuminate\Http\Request;
use App\Http\Resources\RepairResource;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreDeviceRepairRequest;
use App\Http\Requests\UpdateDeviceRepairRequest;
use App\Http\Resources\DeviceRepairResource;
use App\Http\Resources\DeviceResource;
use App\Models\DeviceRepair;

class DeviceRepairController extends Controller
{
    public function create(Device $device)
    {
        return Inertia::render('Admin/DeviceRepairs/Create', [
            'device' => new DeviceResource($device),
            'repairs' => RepairResource::collection(Repair::all())
        ]);
    }

    public function edit(DeviceRepair $deviceRepair)
    {
        return Inertia::render('Admin/DeviceRepairs/Edit', [
            'device' => new DeviceResource($deviceRepair->device),
            'device_repair' => $deviceRepair,
            'repairs' => RepairResource::collection(Repair::all())
        ]);
    }

    public function store(Device $device, StoreDeviceRepairRequest $request)
    {
        DeviceRepair::create([
            'device_id' => $device->id,
            'title' => $request->title,
            'body' => $request->body,
            'price' => $request->price,
            'repair_id' => $request->repair_id
        ]);

        return Redirect::route('devices.edit', $device->slug)->with('success', 'Device updated succesfully.');
    }

    public function update(DeviceRepair $deviceRepair, UpdateDeviceRepairRequest $request)
    {
        $deviceRepair->update([
            'title' => $request->title,
            'body' => $request->body,
            'price' => $request->price,
            'repair_id' => $request->repair_id
        ]);
    }

    public function destroy(DeviceRepair $deviceRepair)
    {
        $deviceRepair->delete();
        return Redirect::route('devices.edit', $deviceRepair->device->slug)->with('success', 'Repair deleted successfully.');
    }
}
