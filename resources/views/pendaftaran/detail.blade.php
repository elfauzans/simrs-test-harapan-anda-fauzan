@extends('layouts.app')

@section('judul', 'Detail Pendaftaran')

@section('konten')
    <header class="d-flex flex-wrap align-items-start justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h4 fw-bold mb-1">Detail Pendaftaran</h1>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('pendaftaran.daftar') }}" class="btn btn-outline-secondary">
                <svg class="ikon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg> Kembali
            </a>
        </div>
    </header>

    <section class="card shadow-sm">
        <div class="card-body d-flex flex-wrap align-items-center gap-3 border-bottom p-4">
            <span class="avatar rounded-circle bg-primary-subtle text-primary-emphasis"><svg class="ikon" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="8" height="4" x="8" y="2" rx="1" ry="1"/><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="M12 11h4"/><path d="M12 16h4"/><path d="M8 11h.01"/><path d="M8 16h.01"/></svg></span>
            <div>
                <h2 class="h5 fw-bold mb-1">{{ $pendaftaran->pasien?->nama ?? '-' }}</h2>
                @if ($pendaftaran->status === 'Menunggu')
                    <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis">{{ $pendaftaran->status }}</span>
                @elseif ($pendaftaran->status === 'Diperiksa')
                    <span class="badge rounded-pill bg-info-subtle text-info-emphasis">{{ $pendaftaran->status }}</span>
                @elseif ($pendaftaran->status === 'Selesai')
                    <span class="badge rounded-pill bg-success-subtle text-success-emphasis">{{ $pendaftaran->status }}</span>
                @else
                    <span class="badge rounded-pill bg-danger-subtle text-danger-emphasis">{{ $pendaftaran->status }}</span>
                @endif
            </div>
            <div class="d-flex gap-2 ms-md-auto">
                <a href="{{ route('pendaftaran.ubah', $pendaftaran) }}" class="btn btn-outline-secondary">
                    <svg class="ikon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg> Ubah
                </a>
                <form method="POST" action="{{ route('pendaftaran.hapus', $pendaftaran) }}" class="d-inline" onsubmit="return confirm(@js('Hapus data pendaftaran '.$pendaftaran->pasien?->nama.'? Data yang dihapus tidak dapat dikembalikan.'))">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <svg class="ikon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg> Hapus
                    </button>
                </form>
            </div>
        </div>

        <dl class="row g-4 p-4 mb-0">
            <div class="col-12 col-md-4">
                <dt class="small text-uppercase text-body-secondary fw-semibold mb-1">No. Rekam Medis</dt>
                <dd class="fw-medium mb-0">{{ $pendaftaran->pasien?->no_rm ?? '-' }}</dd>
            </div>
            <div class="col-12 col-md-4">
                <dt class="small text-uppercase text-body-secondary fw-semibold mb-1">Dokter Tujuan</dt>
                <dd class="fw-medium mb-0">{{ $pendaftaran->dokter?->nama ?? '-' }} ({{ $pendaftaran->dokter?->nama_spesialisasi }})</dd>
            </div>
            <div class="col-12 col-md-4">
                <dt class="small text-uppercase text-body-secondary fw-semibold mb-1">Tanggal Daftar</dt>
                <dd class="fw-medium mb-0">{{ $pendaftaran->tanggal_daftar->translatedFormat('d F Y') }}</dd>
            </div>
            <div class="col-12">
                <dt class="small text-uppercase text-body-secondary fw-semibold mb-1">Keluhan</dt>
                <dd class="fw-medium mb-0">{{ $pendaftaran->keluhan }}</dd>
            </div>
        </dl>
    </section>
@endsection

