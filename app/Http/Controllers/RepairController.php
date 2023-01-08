<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRepairRequest;
use App\Http\Resources\RepairResource;
use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class RepairController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->all('search');
        $repairs = Repair::orderBy('title')
            ->filter($filters)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Auth/Repairs/Index', [
            'repairs' => RepairResource::collection($repairs),
            'filters' => $filters
        ]);
    }

    public function create()
    {
        return Inertia::render('Auth/Repairs/Create');
    }

    public function store(StoreRepairRequest $request)
    {
        Repair::create([
            'title' => $request->title,
            'image' => 'default.png'
        ]);

        return Redirect::route('repairs.index')->with('success', 'Repair added succesfully.');
    }
}
