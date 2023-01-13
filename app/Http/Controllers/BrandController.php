<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->all('search');
        $brands = Brand::orderBy('name')
            ->filter($filters)
            ->paginate(10)
            ->withQueryString();

        return  Inertia::render('Admin/Brands/Index', [
            'brands' => BrandResource::collection($brands),
            'filters' => $filters
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Brands/Create');
    }

    public function store(StoreBrandRequest $request)
    {
        Brand::create([
            'name' => $request->name,
        ]);

        return Redirect::route('brands.index')->with('success', 'Brand added succesfully.');
    }

    public function edit(Brand $brand)
    {
        return Inertia::render('Admin/Brands/Edit', [
            'brand' => new BrandResource($brand)
        ]);
    }

    public function update(Brand $brand, UpdateBrandRequest $request)
    {
        $brand->update([
            'name' => $request->name
        ]);

        return Redirect::route('brands.index')->with('success', 'Brand updated succesfully.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return Redirect::route('brands.index')->with('success', 'Brand deleted successfully.');
    }
}
