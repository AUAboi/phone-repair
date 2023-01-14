<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
  public function index(Request $request)
  {
    $filters = $request->all('search');
    $users =  User::orderBy('first_name')
      ->filter($filters)
      ->paginate(10)
      ->withQueryString();


    return Inertia::render('Admin/Users/Index', [
      'filters' => $filters,
      'users' => UserResource::collection($users)
    ]);
  }
}
