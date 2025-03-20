<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->all('search');
        $categories = Category::orderBy('name')
            ->filter($filters)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Categories/Index', [
            'categories' => CategoryResource::collection($categories),
            'filters' => $filters
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Categories/Create');
    }

    public function store(StoreCategoryRequest $request,)
    {
        try {
            $category = Category::create([
                'name' => $request->name,
            ]);

            if ($category->media) {
                $category->media->delete();
            }
            $productMedia = $category->media()->create([]);
            $productMedia->baseMedia()->associate(
                $productMedia->addMedia($request->image)->toMediaCollection()
            )->save();
        } catch (\Throwable $th) {
            return Redirect::route('categories.create')->with('error', 'Error cant create: ' . $th->getMessage());
        }

        return Redirect::route('categories.index')->with('success', 'Category added succesfully.');
    }

    public function edit(Category $category)
    {
        return Inertia::render('Admin/Categories/Edit', [
            'category' => new CategoryResource($category)
        ]);
    }

    public function update(Category $category, UpdateCategoryRequest $request)
    {
        try {
            $category->update([
                'name' => $request->name,
            ]);

            if ($category->media) {
                $category->media->delete();
            }
            $productMedia = $category->media()->create([]);
            $productMedia->baseMedia()->associate(
                $productMedia->addMedia($request->image)->toMediaCollection()
            )->save();
        } catch (\Throwable $th) {
            return Redirect::route('categories.index')->with('error', 'Error cant update: ' . $th->getMessage());
        }
        return Redirect::route('categories.index')->with('success', 'Category updated succesfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return Redirect::route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
