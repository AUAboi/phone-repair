<?php

namespace App\Services;

use App\Models\Device;
use Illuminate\Support\Facades\DB;

class DeviceService
{
  public function createDevice(array $data)
  {
    DB::transaction(function () use ($data) {
      $device = Device::create([
        'name' => $data['name'],
        'brand_id' => $data['brand_id']
      ]);
      $this->addDeviceImage($device, $data['image']);
    });
  }

  public function updateDevice(Device $device, array $data)
  {
    DB::transaction(function () use ($device, $data) {
      $device->update([
        'name' => $data['name'],
        'brand_id' => $data['brand_id']
      ]);
      $this->addDeviceImage($device, $data['image']);
    });
  }

  public function addDeviceImage(Device $device, $image)
  {
    if ($device->media) {
      $device->media->delete();
    }
    $deviceMedia = $device->media()->create([]);
    $deviceMedia->baseMedia()->associate(
      $deviceMedia->addMedia($image)->toMediaCollection()
    )->save();
  }
}
