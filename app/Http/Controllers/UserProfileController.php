<?php

namespace App\Http\Controllers;

use App\Http\Resources\AppointmentResource;
use App\Http\Resources\OrderResource;
use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = new UserResource($request->user());

        $orders =
            $user
            ->orders()
            ->orderBy('created_at', 'DESC')
            ->get();

        $appointments =
            $user
            ->appointments()
            ->orderBy('created_at', 'DESC')
            ->get();

        return Inertia::render("Public/Profile/Index",  [
            "user" => $user,
            "appointments" => AppointmentResource::collection($appointments),
            "orders" => OrderResource::collection($orders)
        ]);
    }
}
