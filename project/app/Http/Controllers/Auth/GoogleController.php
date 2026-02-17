<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if (!$user) {
                return redirect('/login')->with('error', 'Akun Anda belum terdaftar di sistem. Silakan hubungi admin untuk mendaftarkan akun.');
            }

            $user->update([
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
            ]);

            Auth::login($user);

            return redirect()->intended('/admin/dashboard');

        }
        catch (\Exception $e) {
            return redirect('/login')->with('error', 'Google authentication failed: ' . $e->getMessage());
        }
    }
}
