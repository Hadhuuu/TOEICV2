<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\MahasiswaProfile; // Tambahkan ini

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // Eager load mahasiswaProfile untuk dikirim ke view partial
        $request->user()->load('mahasiswaProfile');
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->only('name', 'email')); // Hanya name dan email untuk User model

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Update atau buat MahasiswaProfile
        // Pastikan field yang di-request ada dan tidak null jika required di DB
        MahasiswaProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'nim' => $request->nim ?? $user->mahasiswaProfile->nim ?? null, // Pertahankan nim lama jika tidak diisi & sudah ada
                'nik' => $request->nik ?? null,
                'no_wa' => $request->no_wa ?? null,
                'alamat_asal' => $request->alamat_asal ?? null,
                'alamat_sekarang' => $request->alamat_sekarang ?? null,
                'program_studi' => $request->program_studi ?? null,
                'jurusan' => $request->jurusan ?? null,
                'kampus' => $request->kampus ?? null,
            ]
        );

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    // ... (destroy method)
}