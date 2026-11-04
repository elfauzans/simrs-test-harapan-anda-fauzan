<?php

namespace App\Http\Controllers;

use App\Http\Requests\PendaftaranRequest;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PendaftaranController extends Controller
{
    public function daftar(Request $request): View
    {
        $kataKunci = $request->query('cari');

        $daftarPendaftaran = Pendaftaran::with(['pasien', 'dokter'])
            ->when($kataKunci, fn (Builder $query) => $query->where(function (Builder $subQuery) use ($kataKunci) {
                $subQuery->whereAny(['keluhan', 'status'], 'like', "%{$kataKunci}%")
                    ->orWhereHas('pasien', fn (Builder $q) => $q->whereAny(['nama', 'no_rm'], 'like', "%{$kataKunci}%"))
                    ->orWhereHas('dokter', fn (Builder $q) => $q->where('nama', 'like', "%{$kataKunci}%"));
            }))
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('pendaftaran.daftar', ['daftarPendaftaran' => $daftarPendaftaran]);
    }

    public function tambah(): View
    {
        return view('pendaftaran.form', [
            'pendaftaran' => new Pendaftaran,
            'daftarPasien' => Pasien::orderBy('nama')->get(),
            'daftarDokter' => Dokter::orderBy('nama')->get(),
        ]);
    }

    public function simpan(PendaftaranRequest $request): RedirectResponse
    {
        Pendaftaran::create($request->validated());

        return to_route('pendaftaran.daftar')->with('sukses', 'Data pendaftaran berhasil ditambahkan.');
    }

    public function detail(Pendaftaran $pendaftaran): View
    {
        $pendaftaran->load(['pasien', 'dokter']);

        return view('pendaftaran.detail', ['pendaftaran' => $pendaftaran]);
    }

    public function ubah(Pendaftaran $pendaftaran): View
    {
        return view('pendaftaran.form', [
            'pendaftaran' => $pendaftaran,
            'daftarPasien' => Pasien::orderBy('nama')->get(),
            'daftarDokter' => Dokter::orderBy('nama')->get(),
        ]);
    }

    public function perbarui(PendaftaranRequest $request, Pendaftaran $pendaftaran): RedirectResponse
    {
        $pendaftaran->update($request->validated());

        return to_route('pendaftaran.detail', $pendaftaran)->with('sukses', 'Data pendaftaran berhasil diperbarui.');
    }

    public function hapus(Pendaftaran $pendaftaran): RedirectResponse
    {
        $pendaftaran->delete();

        return to_route('pendaftaran.daftar')->with('sukses', 'Data pendaftaran berhasil dihapus.');
    }
}

