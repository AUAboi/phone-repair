<?php

namespace App\Actions;

use App\Models\Product;
use App\Models\User;
use Darryldecode\Cart\Cart;

class RemoveFromCart
{
  public function handle(Product $product)
  {
    $cartItem = \Cart::get($product->id);
    if (!$cartItem) {
      return;
    }
    if ($cartItem->quantity > 1) {
      \Cart::update($product->id, array(
        'quantity' => -1,
      ));
    } else {
      \Cart::remove($product->id);
    }
  }
}
