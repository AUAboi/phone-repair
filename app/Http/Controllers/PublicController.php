<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Http\Resources\DeviceResource;
use App\Models\Brand;
use App\Models\Device;
use Inertia\Inertia;

class PublicController extends Controller
{
    public function home()
    {
        return Inertia::render('Public/Home', [
            'brands' => BrandResource::collection(Brand::all()->load('devices'))
        ]);
    }

    public function repairs()
    {
        return Inertia::render(
            'Public/Repairs',
            [
                'brands' => BrandResource::collection(Brand::all()),
                'devices' => DeviceResource::collection(Device::all())
            ]
        );
    }

    public function contact()
    {
        return Inertia::render('Public/Contact');
    }

    public function repairBrand(Brand $brand)
    {
        return Inertia::render('Public/Brand', [
            'brand' => new BrandResource($brand->load('devices'))
        ]);
    }
}
