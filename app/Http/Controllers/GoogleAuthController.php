<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    /**
     * Redirect ke halaman login Google
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Beresin data setelah user login di Google
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/admin/login')->with('error', 'Gagal login via Google.');
        }

        // Cari user dulu
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Kalau belum ada, buat baru
            $user = User::create([
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'password' => bcrypt(Str::random(24)),
                'role' => ($googleUser->getEmail() === 'aldirenaldi1111@gmail.com') ? 'super_admin' : 'staff',
            ]);
        } else {
            // Kalau sudah ada, update datanya aja
            $user->update([
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
            ]);
        }

        Auth::login($user);

        // Redirect sesuai Role & Panel
        if (in_array($user->role, ['super_admin', 'admin'])) {
            return redirect()->intended('/admin');
        }

        return redirect()->intended('/app');
    }
}
