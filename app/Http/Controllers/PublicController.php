<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\DeviceResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\ProductResource;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Device;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PublicController extends Controller
{
    public function home()
    {
        $posts =  Post::orderBy('updated_at')
            ->with(['media', 'media.baseMedia'])
            ->publishedPosts()
            ->get();

        return Inertia::render('Public/Home', [
            'brands' => BrandResource::collection(Brand::all()->load('devices')),
            'posts' => PostResource::collection($posts),
            'categories' => CategoryResource::collection(Category::orderBy('name', 'ASC')->get()->load('products', 'products.category')),
            'products' => ProductResource::collection(Product::inRandomOrder()->get())
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

    public function about()
    {
        return Inertia::render('Public/About');
    }

    public function orderTracking()
    {
        return Inertia::render('Public/OrderTracking');
    }

    public function appointmentTracking()
    {
        return Inertia::render('Public/AppointmentTracking');
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

    public function categoryBrands(string $deviceCategory)
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

    public function shop(Request $request)
    {
        $filters = $request->all('search');
        $products = Product::orderBy('name')
            ->with(['category'])
            ->filter($filters)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Public/Shop/Index', [
            'categories' => CategoryResource::collection(Category::orderBy('name', 'ASC')->get()),
            'products' => ProductResource::collection($products),
            'filters' => $filters
        ]);
    }

    public function product(Product $product)
    {
        return Inertia::render('Public/Product/Show', [
            'product' => new ProductResource($product->load('category')),
            'products' => ProductResource::collection(Product::all()->except($product->id))
        ]);
    }

    public function categoryProducts(Category $category)
    {
        return Inertia::render('Public/CategoryProducts', [
            'category' => new CategoryResource($category->load('products', 'products.category')),
        ]);
    }

    public function terms()
    {
        return Inertia::render('Public/Terms');
    }
}
