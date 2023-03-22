<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->all('search');
        $products = Product::orderBy('name')
            ->with(['category'])
            ->filter($filters)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Products/Index', [
            'products' => ProductResource::collection($products),
            'filters' => $filters
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Products/Create', [
            'categories' => CategoryResource::collection(Category::all())
        ]);
    }

    public function store(StoreProductRequest $request, ProductService $productService)
    {
        try {
            $productService->createProduct($request->validated());
        } catch (\Throwable $th) {
            return Redirect::route('products.create')->with('error', 'Error cant create: ' . $th->getMessage());
        }

        return Redirect::route('products.index')->with('success', 'Product added succesfully.');
    }

    public function edit(Product $product)
    {
        return Inertia::render('Admin/Products/Edit', [
            'product' => new ProductResource($product->load('category', 'media')),
            'categories' => CategoryResource::collection(Category::all())
        ]);
    }

    public function update(UpdateProductRequest $request, ProductService $productService, Product $product)
    {
        try {
            $productService->updateProduct($product, $request->validated());
        } catch (\Throwable $th) {
            return Redirect::route('products.index')->with('error', 'Error cant update: ' . $th->getMessage());
        }

        return Redirect::route('products.index')->with('success', 'Product added succesfully.');
    }


    public function destroy(Product $product)
    {
        DB::transaction(function () use ($product) {
            if ($product->media) {
                $product->media->delete();
            }
            $product->delete();
        });


        return Redirect::route('products.index')->with('success', 'Product deleted successfully.');
    }
}
