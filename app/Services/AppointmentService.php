<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Device;
use App\Models\DeviceRepair;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;

class AppointmentService
{
  public function createAppointment(Device $device, array $data, User $user = null)
  {

    DB::transaction(function () use ($device, $user, $data) {
      $time  =  $data['appointment_time']['hours'] . ":" . $data['appointment_time']['minutes'];
      $timestamp = strtotime($time);

      $appointment = Appointment::create([
        'user_id' => $user ? $user->id : null,
        'device_id' => $device->id,
        'device_repair_id' => $data['device_repair_id'],
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'zip_code' => $data['zip_code'],
        'city' => $data['city'],
        'address' => $data['address'],
        'appointment_date' => Carbon::parse($data['appointment_date'])->toDate(),
        'appointment_time' => Carbon::parse($timestamp)->toTimeString(),
        'total' => DeviceRepair::find($data['device_repair_id'])->price
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
