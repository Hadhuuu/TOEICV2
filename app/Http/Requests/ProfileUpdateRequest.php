<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $userId = $this->user()->id;
        $mahasiswaProfileId = $this->user()->mahasiswaProfile->id ?? null;

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($userId)],
            
            // Validasi untuk MahasiswaProfile
            // NIM mungkin unik atau tidak, tergantung kebijakan. Jika unik dan tidak boleh diedit setelah diset:
            // 'nim' => ['nullable', 'string', 'max:20', Rule::unique('mahasiswa_profiles')->ignore($mahasiswaProfileId)],
            // Jika NIM di-set saat pendaftaran dan readonly di profil:
            'nim' => ['nullable', 'string', 'max:20'], // Atau 'sometimes' jika tidak selalu dikirim
            'nik' => ['nullable', 'string', 'max:30', Rule::unique('mahasiswa_profiles', 'nik')->ignore($mahasiswaProfileId)],
            'no_wa' => ['nullable', 'string', 'max:20'],
            'alamat_asal' => ['nullable', 'string', 'max:255'],
            'alamat_sekarang' => ['nullable', 'string', 'max:255'],
            'program_studi' => ['nullable', 'string', 'max:100'],
            'jurusan' => ['nullable', 'string', 'max:100'],
            'kampus' => ['nullable', 'string', Rule::in(['Utama', 'PSDKU Kediri', 'PSDKU Lumajang', 'PSDKU Pamekasan'])],
        ];
    }
}