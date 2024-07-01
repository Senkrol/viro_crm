<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function register(Request $request)
  {
    // validate
    $fields = $request->validate([
      'name' => ['required', 'max:255'],
      'email' => ['required', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'confirmed']
    ]);
  

    //register
    $user = User::create($fields);

    // login
    Auth::login($user);


    //redirect
    return redirect()->route('home');

  }
}
