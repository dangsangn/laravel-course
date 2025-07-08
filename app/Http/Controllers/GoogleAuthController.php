<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
  public function redirectToGoogle()
  {
    return Socialite::driver('google')->redirect();
  }

  public function handleGoogleCallback()
  {
    try {
      $googleUser = Socialite::driver('google')->user();

      $user = User::where('google_id', $googleUser->getId())->first();

      if (!$user) {
        // Check if user exists with the same email
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
          // Update existing user with Google ID
          $user->update([
            'google_id' => $googleUser->getId(),
            'email_verified_at' => now(),
          ]);
        } else {
          // Create new user
          $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'email_verified_at' => now(),
            'password' => bcrypt(Str::random(16)), // Random password for Google users
          ]);
        }
      }

      Auth::login($user);

      return redirect()->route('home')->with('success', 'Successfully logged in with Google!');
    } catch (\Exception $e) {
      return redirect()->route('show.signin')->with('error', 'Google login failed. Please try again.');
    }
  }
}
