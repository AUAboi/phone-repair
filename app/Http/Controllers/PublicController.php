<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PublicController extends Controller
{
    public function home()
    {
        return Inertia::render('Public/Home', [
            'brands' => BrandResource::collection(Brand::all())
        ]);
    }

    public function repairs()
    {
        return Inertia::render('Public/Repairs');
    }
}
