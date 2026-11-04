<?php

namespace App\Http\Requests;

use App\Models\Pendaftaran;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PendaftaranRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'pasien_id' => ['required', Rule::exists('pasien', 'id')],
            'dokter_id' => ['required', Rule::exists('dokter', 'id')],
            'tanggal_daftar' => ['required', 'date'],
            'keluhan' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::in(array_keys(Pendaftaran::STATUS))],
        ];
    }
}

