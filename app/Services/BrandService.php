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

  public function updateBrand(Brand $brand, array $data)
  {
    DB::transaction(function () use ($brand, $data) {
      $brand->update([
        'name' => $data['name'],
      ]);
      $this->addBrandImage($brand, $data['image']);
    });
  }

  public function addBrandImage(Brand $brand, $image)
  {
    if ($brand->media) {
      $brand->media->delete();
    }
    $brandMedia = $brand->media()->create([]);
    $brandMedia->baseMedia()->associate(
      $brandMedia->addMedia($image)->toMediaCollection()
    )->save();
  }
}
