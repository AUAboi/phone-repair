<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CheckoutController extends Controller
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
                'associatedModel' => $item->associatedModel,
                'quantity' => $item->quantity,
                'total_price' => money($item->associatedModel->price * $item->quantity, config('constants.currency'), true)->format(),
            ]);
        }


        if (!count($cartContent)) {
            return redirect()->route('cart.index');
        }

        return Inertia::render('Public/Checkout/Index', [
            'cartContents' => [
                'content' => $cartContent,
                'total' => money(\Cart::getTotal(), config('constants.currency'), true)->formatWithoutZeroes(),
                'quantity' => \Cart::getTotalQuantity()
            ]
        ]);
    }
}
