<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Actions\AddToCart;
use Illuminate\Http\Request;
use App\Actions\RemoveFromCart;

class CartController extends Controller
{
    public function index()
    {
        if (auth()->id()) {
            \Cart::session(auth()->id());
        } else {
            \Cart::session(request()->session()->getId());
        }

        $row = \Cart::getContent();

        $cartContent = [];
        if ($row->count()) {
            // remove from cart if item doesnt exist anymore
            foreach ($row as $key => $item) {
                $product = Product::find($item->id);
                if (!$product) {
                    \Cart::remove($item->id);
                    unset($row[$key]);
                }
            }

            $cartContent = $row->transform(fn($item) => [
                'id' => $item->id,
                'name' => $item->associatedModel->name,
                'price' => $item->associatedModel->formatted_price,
                'quantity' => $item->quantity,

                'total_price' => money($item->associatedModel->price * $item->quantity, config('constants.currency'), true)->format(),
            ]);
        }

        return Inertia::render('Public/Cart/Index', [
            'cartContents' => [
                'content' => $cartContent,
                'total' => money(\Cart::getTotal(), config('constants.currency'), true)->format(),
                'quantity' => \Cart::getTotalQuantity()
            ]
        ]);
    }

    public function add(Request $request, AddToCart $addToCart)
    {
        if (auth()->id()) {
            \Cart::session(auth()->id());
        } else {
            \Cart::session(request()->session()->getId());
        }

        $request->validate([
            'id' => 'required|exists:products,id'
        ]);

        $product = Product::select([
            'id',
            'name',
            'price'
        ])
            ->findOrFail($request->id);

        $addToCart->handle($product);

        return redirect()->back()->with('success', 'Added successfully');
    }

    public function remove(Request $request, RemoveFromCart $removeFromCart)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
        ]);

        if (auth()->id()) {
            \Cart::session(auth()->id());
        } else {
            \Cart::session(request()->session()->getId());
        }


        $product = Product::findOrFail($request->id);

        $removeFromCart->handle($product);

        return redirect()->back()->with('success', 'Removed successfully');
    }

    public function removeItem(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
        ]);

        if (auth()->id()) {
            \Cart::session(auth()->id());
        } else {
            \Cart::session(request()->session()->getId());
        }


        \Cart::remove($request->id);

        return redirect()->back()->with('success', 'Removed successfully');
    }
}
