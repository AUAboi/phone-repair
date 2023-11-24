<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\DeviceResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Device;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PublicController extends Controller
{
    public function home()
    {
        return Inertia::render('Public/Home', [
            'brands' => BrandResource::collection(Brand::all()->load('devices')),
            'categories' => CategoryResource::collection(Category::orderBy('name', 'ASC')->get()->load('products', 'products.category'))
        ]);
    }

    public function repairs()
    {
        return Inertia::render(
            'Public/Repairs',
            [
                'brands' => BrandResource::collection(Brand::all()->load('media', 'devices', 'media.baseMedia')),
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

    public function products()
    {
        return Inertia::render('Public/Products', [
            'categories' => CategoryResource::collection(Category::orderBy('name', 'ASC')->get()->load('products', 'products.category'))
        ]);
    }

    public function categoryBrands(Request $request, string $deviceCategory)
    {
        $deviceCategories = config('constants.deviceCategories');
        if (!in_array($deviceCategory, $deviceCategories, true)) {
            return redirect()->back();
        }

        return Inertia::render('Public/CategoryBrands', [
            'brands' => BrandResource::collection(Brand::where($deviceCategory, 1)->get()),
            'deviceCategory' => $deviceCategory
        ]);
    }
}
