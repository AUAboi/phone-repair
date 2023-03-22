<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductService
{
  public function createProduct(array $data)
  {
    DB::transaction(function () use ($data) {
      $product = Product::create([
        'name' => $data['name'],
        'price' => $data['price'],
        'body' => $data['body'],
        'category_id' => $data['category_id']
      ]);
      $this->addProductImage($product, $data['image']);
    });
  }

  public function updateProduct(Product $product, array $data)
  {
    DB::transaction(function () use ($product, $data) {
      $product->update([
        'name' => $data['name'],
        'price' => $data['price'],
        'body' => $data['body'],
        'category_id' => $data['category_id']
      ]);
      $this->addProductImage($product, $data['image']);
    });
  }

  public function addProductImage(Product $product, $image)
  {
    if ($product->media) {
      $product->media->delete();
    }
    $productMedia = $product->media()->create([]);
    $productMedia->baseMedia()->associate(
      $productMedia->addMedia($image)->toMediaCollection()
    )->save();
  }
}
