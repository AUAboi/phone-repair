<?php

namespace App\Actions;

use App\Models\Product;
use App\Models\User;
use Darryldecode\Cart\Cart;

class AddToCart
{
  public function handle(Product $product)
  {
    \Cart::add(array(
      'id' => $product->id, // unique row ID
      'name' => $product->name,
      'price' => $product->price,
      'quantity' => 1,
      'associatedModel' => $product
    ));
  }
}
