<?php

namespace App\Http\Middleware;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\DeviceResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserResource;
use App\Models\Category;
use App\Models\Device;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = null;
        if ($request->user()) {
            $user = new UserResource($request->user());
            \Cart::session($request->user()->id);
        } else {
            \Cart::session($request->session()->getId());
        }

        $cartCollection = \Cart::getContent();

        return array_merge(parent::share($request), [
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error'),
                ];
            },
            'auth' => [
                'user' => $user,
            ],
            'logo' => 'logo-min-resized.png',
            'navigation' => [
                'devices' => DeviceResource::collection(Device::all()),
                'categories' => CategoryResource::collection(Category::all())
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'cart' => [
                'length' => $cartCollection->count(),
                'content' => $cartCollection,
                'total' => money(\Cart::getTotal(), config('constants.currency'), true)
                    ->formatWithoutZeroes(),
            ],
        ]);
    }
}
