<?php

namespace App\Services;

use DateTime;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Device;
use App\Models\Product;
use App\Models\Appointment;
use App\Models\DeviceRepair;
use App\Mail\AppointmentBooked;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AppointmentService
{
  public function createAppointment(Device $device, array $data, User $user = null)
  {

    DB::transaction(function () use ($device, $user, $data) {
      $time  =  $data['appointment_time']['hours'] . ":" . $data['appointment_time']['minutes'];
      $timestamp = strtotime($time);

      $deviceRepair = DeviceRepair::find($data['device_repair_id']);
      $appointment = Appointment::create([
        'user_id' => $user ? $user->id : null,
        'device_id' => $device->id,
        'device_name' => 'Repair ' . $device->name,
        'device_repair_id' => $data['device_repair_id'],
        'device_repair_title' => $data['device_repair_id'],
        'device_repair_price' => $deviceRepair->price,
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'zip_code' => $data['zip_code'],
        'city' => $data['city'],
        'message' => $data['message'],
        'address' => $data['address'],
        'appointment_date' => Carbon::parse($data['appointment_date'])->toDate(),
        'appointment_time' => Carbon::parse($timestamp)->toTimeString(),
        'total' => $deviceRepair->price
      ]);

      $appointment->appointment_number = $this->generateIdentifier($appointment);
      $appointment->save();

      Mail::to($appointment->email)->send(new AppointmentBooked($appointment));

      return $appointment;
    });
  }

  public function createProductAppointment(Product $product, array $data, User $user = null)
  {

    DB::transaction(function () use ($product, $user, $data) {
      $time  =  $data['appointment_time']['hours'] . ":" . $data['appointment_time']['minutes'];
      $timestamp = strtotime($time);

      $appointment = Appointment::create([
        'user_id' => $user ? $user->id : null,
        'device_id' => null,
        'device_repair_id' => null,
        'device_name' => $product->name,
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'zip_code' => $data['zip_code'],
        'city' => $data['city'],
        'address' => $data['address'],
        'message' => $data['message'],
        'appointment_date' => Carbon::parse($data['appointment_date'])->toDate(),
        'appointment_time' => Carbon::parse($timestamp)->toTimeString(),
        'total' => $product->price
      ]);

      $appointment->appointment_number = $this->generateIdentifier($appointment);
      $appointment->save();
    });
  }

  public function generateIdentifier(Appointment $appointment)
  {
    $id =  $appointment->user ? $appointment->user->id : 0;

    return $appointment->device_repair_id . $appointment->created_at->format('Ymd') . $id . $appointment->id;
  }
}
