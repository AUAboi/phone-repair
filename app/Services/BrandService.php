<?php

namespace App\Services;

use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class BrandService
{
  public function createBrand(array $data)
  {
    DB::transaction(function () use ($data) {
      $brand = Brand::create([
        'name' => $data['name']
      ]);
      $this->addBrandImage($brand, $data['image']);
    });
  }

  public function addBrandImage(Brand $brand, $image)
  {
    $brandMedia = $brand->media()->create([]);
    $brandMedia->baseMedia()->associate(
      $brandMedia->addMedia($image)->toMediaCollection()
    )->save();
  }
}
