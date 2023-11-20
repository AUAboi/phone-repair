<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = new UserResource($request->user()->load(['orders']));

        return Inertia::render("Public/Profile/Index",  ["user" => $user]);
    }
}
