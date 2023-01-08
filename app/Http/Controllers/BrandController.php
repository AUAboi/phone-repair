<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->all('search');
        $brands = Brand::orderBy('name')
            ->filter($filters)
            ->paginate(9)
            ->withQueryString()
            ->through(fn ($dish) => [
                'id' => $dish->id,
                'name' => $dish->name,
            ]);


        return  Inertia::render('Brands/Index', [
            'brands' => BrandResource::collection($brands),
            'filters' => $filters
        ]);
    }
}
