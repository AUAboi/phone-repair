<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRepairRequest;
use App\Http\Requests\UpdateRepairRequest;
use App\Http\Resources\RepairResource;
use App\Models\Repair;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        try {
            DB::transaction(function () use ($request) {
                $repair = Repair::create([
                    'title' => $request->title,
                ]);
                $repairMedia = $repair->media()->create([]);
                $repairMedia->baseMedia()->associate(
                    $repairMedia->addMedia($request->image)->toMediaCollection()
                )->save();
            });
        } catch (\Throwable $th) {
            return Redirect::route('repairs.create')->with('error', 'Error cant create: ' . $th->getMessage());
        }

        return Redirect::route('repairs.index')->with('success', 'Repair added succesfully.');
    }

    public function edit(Repair $repair)
    {
        return Inertia::render('Admin/Repairs/Edit', [
            'repair' => new RepairResource($repair->load('media'))
        ]);
    }

    public function update(Repair $repair, UpdateRepairRequest $request)
    {
        try {
            DB::transaction(function () use ($request, $repair) {
                $repair->update([
                    'title' => $request->title
                ]);

                if ($repair->media) {
                    $repair->media->delete();
                }
                $repairMedia = $repair->media()->create([]);
                $repairMedia->baseMedia()->associate(
                    $repairMedia->addMedia($request->image)->toMediaCollection()
                )->save();
            });
        } catch (\Throwable $th) {
            return Redirect::route('repairs.index')->with('error', 'Error cant update: ' . $th->getMessage());
        }


        return Redirect::route('repairs.index')->with('success', 'Repair updated succesfully.');
    }

    public function destroy(Repair $repair)
    {
        $repair->delete();
        return Redirect::route('repairs.index')->with('success', 'Repair type deleted successfully.');
    }
}
