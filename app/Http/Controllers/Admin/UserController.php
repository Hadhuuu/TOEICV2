<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MahasiswaProfile; // Untuk membuat profil saat user mahasiswa dibuat
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query()->with('mahasiswaProfile')->orderBy('created_at', 'desc');

        // Fitur Pencarian Sederhana
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Fitur Filter berdasarkan Role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        $users = $query->paginate(10)->withQueryString(); // withQueryString agar parameter search & role tetap ada di link pagination

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,mahasiswa'],
            // Field profil mahasiswa (opsional saat pembuatan user, bisa diisi nanti)
            'nim' => ['nullable', 'string', 'max:20', 'unique:mahasiswa_profiles,nim'],
            'nik' => ['nullable', 'string', 'max:30', 'unique:mahasiswa_profiles,nik'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'email_verified_at' => now(), // Anggap admin membuat user yang langsung terverifikasi
        ]);

        // Jika role mahasiswa dan NIM diisi, buat juga profilnya
        if ($user->role === 'mahasiswa' && $request->filled('nim')) {
            MahasiswaProfile::create([
                'user_id' => $user->id,
                'nim' => $request->nim,
                'nik' => $request->nik,
                // Isi field profile lainnya dengan default atau null jika perlu
                'no_wa' => $request->no_wa ?? 'Belum Diisi',
                'alamat_asal' => $request->alamat_asal ?? 'Belum Diisi',
                'alamat_sekarang' => $request->alamat_sekarang ?? 'Belum Diisi',
                'program_studi' => $request->program_studi ?? 'Belum Diisi',
                'jurusan' => $request->jurusan ?? 'Belum Diisi',
                'kampus' => $request->kampus ?? 'Utama',
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Untuk saat ini, kita bisa arahkan ke edit atau buat view detail khusus
        $user->load('mahasiswaProfile');
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->load('mahasiswaProfile'); // Load profile jika ada
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'string', 'in:admin,mahasiswa'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            // Validasi untuk update profile mahasiswa
            'nim' => ['nullable', 'string', 'max:20', 'unique:mahasiswa_profiles,nim,' . ($user->mahasiswaProfile->id ?? 'NULL') . ',id,user_id,' . $user->id ],
            'nik' => ['nullable', 'string', 'max:30', 'unique:mahasiswa_profiles,nik,' . ($user->mahasiswaProfile->id ?? 'NULL') . ',id,user_id,' . $user->id ],
             // tambahkan field profile lain
            'no_wa' => ['nullable', 'string', 'max:20'],
            'alamat_asal' => ['nullable', 'string'],
            'alamat_sekarang' => ['nullable', 'string'],
            'program_studi' => ['nullable', 'string', 'max:100'],
            'jurusan' => ['nullable', 'string', 'max:100'],
            'kampus' => ['nullable', 'string', 'in:Utama,PSDKU Kediri,PSDKU Lumajang,PSDKU Pamekasan'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // Update atau buat profile jika mahasiswa
        if ($user->role === 'mahasiswa') {
            MahasiswaProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nim' => $request->nim ?? $user->mahasiswaProfile->nim ?? null,
                    'nik' => $request->nik ?? $user->mahasiswaProfile->nik ?? null,
                    'no_wa' => $request->no_wa ?? $user->mahasiswaProfile->no_wa ?? 'Belum Diisi',
                    'alamat_asal' => $request->alamat_asal ?? $user->mahasiswaProfile->alamat_asal ?? 'Belum Diisi',
                    'alamat_sekarang' => $request->alamat_sekarang ?? $user->mahasiswaProfile->alamat_sekarang ?? 'Belum Diisi',
                    'program_studi' => $request->program_studi ?? $user->mahasiswaProfile->program_studi ?? 'Belum Diisi',
                    'jurusan' => $request->jurusan ?? $user->mahasiswaProfile->jurusan ?? 'Belum Diisi',
                    'kampus' => $request->kampus ?? $user->mahasiswaProfile->kampus ?? 'Utama',
                ]
            );
        }


        return redirect()->route('admin.users.index')->with('success', 'Data user berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Hati-hati: Pertimbangkan foreign key constraints dan data terkait.
        // Mungkin lebih baik soft delete atau menonaktifkan user.
        // Jika user adalah admin terakhir, jangan biarkan dihapus.
        if ($user->role === 'admin' && User::where('role', 'admin')->count() === 1) {
            return redirect()->route('admin.users.index')->with('error', 'Tidak dapat menghapus admin terakhir.');
        }

        try {
            // Jika ada profile, hapus dulu atau set onDelete('cascade') di migration
            if($user->mahasiswaProfile) {
                $user->mahasiswaProfile->delete();
            }
            // Hapus juga data pendaftaran, jadwal peserta, hasil ujian, dll. jika perlu
            // atau pastikan onDelete('cascade') pada migration.

            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Tangani error foreign key jika ada data terkait yang tidak bisa dihapus
            return redirect()->route('admin.users.index')->with('error', 'Gagal menghapus user. Mungkin masih ada data terkait (pendaftaran, dll).');
        }
    }
}