<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brand =  Brand::create(['name' => 'Apple']);
        $brand->devices()->create(['name' => 'iPhone X']);
        $brand =  Brand::create(['name' => 'Samsung']);
        $brand->devices()->create(['name' => 'Galaxy S3']);
        $brand =  Brand::create(['name' => 'Google']);
        $brand->devices()->create(['name' => 'Pixel 3']);
    }
}
