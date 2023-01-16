<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeviceResource;
use App\Models\Device;

class DeviceController extends Controller
{
  public function index()
  {
    return DeviceResource::collection(Device::all());
  }
}
