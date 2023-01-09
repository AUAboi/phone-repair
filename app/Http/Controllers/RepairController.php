<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRepairRequest;
use App\Http\Requests\UpdateRepairRequest;
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

        return Inertia::render('Admin/Repairs/Index', [
            'repairs' => RepairResource::collection($repairs),
            'filters' => $filters
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Repairs/Create');
    }

    public function store(StoreRepairRequest $request)
    {
        Repair::create([
            'title' => $request->title,
            'image' => 'default.png'
        ]);

        return Redirect::route('repairs.index')->with('success', 'Repair added succesfully.');
    }

    public function edit(Repair $repair)
    {
        return Inertia::render('Admin/Repairs/Edit', [
            'repair' => new RepairResource($repair)
        ]);
    }

    public function update(Repair $repair, UpdateRepairRequest $request)
    {
        $repair->update([
            'title' => $request->title
        ]);

        return Redirect::route('repairs.index')->with('success', 'Brand updated succesfully.');
    }

    public function destroy(Repair $repair)
    {
        $repair->delete();
        return Redirect::route('repairs.index')->with('success', 'Repair type deleted successfully.');
    }
}
