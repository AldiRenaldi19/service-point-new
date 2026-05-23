<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Mengalihkan Pengguna ke Halaman Otentikasi Google
     * * Mengamankan deteksi asal panel (Admin / App Client) melalui Session Flash.
     */
    public function redirect(Request $request): RedirectResponse
    {
        if ($request->has('panel')) {
            session(['login_from_panel' => $request->get('panel')]);
        } else {
            $referer = $request->headers->get('referer', '');

            if (str_contains($referer, '/app')) {
                session(['login_from_panel' => 'app']);
            } else {
                session(['login_from_panel' => 'admin']);
            }
        }

        return Socialite::driver('google')->redirect();
    }

    /**
     * Memproses Data Balikan (Callback) dari Google OAuth
     * * Hacker Protection: Session Regeneration untuk mencegah pembajakan Session ID (Session Fixation).
     */
    public function callback(Request $request): RedirectResponse
    {
        $fromPanel = session('login_from_panel', 'app');

        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/' . $fromPanel . '/login')
                ->with('error', 'Gagal melakukan autentikasi via Google Sign-In.');
        }

        // Ambil email dari payload Google
        $email = $googleUser->getEmail();

        // Cari atau buat entitas user baru secara aman
        $user = User::where('email', $email)->first();

        if (! $user) {
            // Pengondisian dinamis Super Admin utama (Ambil dari .env atau fallback email aman milikmu)
            $targetSuperAdmin = env('ADMIN_INITIAL_EMAIL', 'aldirenaldi1111@gmail.com');
            $defaultRole = ($email === $targetSuperAdmin) ? 'super_admin' : 'customer';

            $user = User::create([
                'email' => $email,
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'password' => bcrypt(Str::random(32)), // Ditingkatkan menjadi 32 karakter acak agar string password lebih kuat
                'role' => $defaultRole,
            ]);
        } else {
            // Update data profil terbaru dari Google secara berkala saat login berhasil
            $user->update([
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
            ]);
        }

        // ====================================================================
        // 🔒 ANTI-HACKER COUNTERMEASURE: SESSION REGENERATION (SESSION FIXATION)
        // ====================================================================
        // Menghapus token sesi lama dan menerbitkan token ID sesi baru yang segar 
        // setelah status tamu berubah menjadi terautentikasi (Log In).
        Auth::login($user);
        $request->session()->regenerate();

        session()->forget('login_from_panel');

        // --- SISTEM PENGALIHAN OTOMATIS BERDASARKAN OTORISASI ROLE ---
        if (in_array($user->role, ['super_admin', 'admin'], true)) {
            return redirect()->intended('/admin');
        }

        if (in_array($user->role, ['customer', 'staff'], true)) {
            return redirect()->intended('/app');
        }

        return redirect('/');
    }
}
