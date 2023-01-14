<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeviceRequest;
use App\Http\Requests\UpdateDeviceRequest;
use App\Http\Resources\BrandResource;
use App\Http\Resources\DeviceResource;
use App\Models\Brand;
use App\Models\Device;
use App\Services\DeviceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class DeviceController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->all('search');
        $devices = Device::orderBy('name')
            ->with(['brand'])
            ->filter($filters)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Devices/Index', [
            'devices' => DeviceResource::collection($devices),
            'filters' => $filters
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Devices/Create', [
            'brands' => BrandResource::collection(Brand::all())
        ]);
    }

    public function store(DeviceService $deviceService, StoreDeviceRequest $request)
    {
        try {
            $deviceService->createDevice($request->validated());
        } catch (\Throwable $th) {
            return Redirect::route('devices.create')->with('error', 'Error cant create: ' . $th->getMessage());
        }

        return Redirect::route('devices.index')->with('success', 'Device added succesfully.');
    }

    public function update(Device $device, UpdateDeviceRequest $request, DeviceService $deviceService)
    {
        try {
            $deviceService->updateDevice($device, $request->validated());
        } catch (\Throwable $th) {
            return Redirect::route('devices.index')->with('error', 'Error cant update: ' . $th->getMessage());
        }

        return Redirect::route('devices.index')->with('success', 'Device updated succesfully.');
    }

    public function edit(Device $device)
    {
        return Inertia::render('Admin/Devices/Edit', [
            'device' => new DeviceResource($device->load(['brand', 'repairs'])),
            'brands' => BrandResource::collection(Brand::all())
        ]);
    }

    public function destroy(Device $device)
    {
        DB::transaction(function () use ($device) {
            if ($device->media) {
                $device->media->delete();
            }
            $device->delete();
        });

        return Redirect::route('devices.index')->with('success', 'Device deleted successfully.');
    }
}
