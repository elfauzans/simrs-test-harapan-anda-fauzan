@extends('layouts.app')

@section('judul', $pendaftaran->exists ? 'Ubah Data Pendaftaran' : 'Tambah Pendaftaran')

@section('konten')
    <header class="d-flex flex-wrap align-items-start justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h4 fw-bold mb-1">{{ $pendaftaran->exists ? 'Ubah Data Pendaftaran' : 'Tambah Pendaftaran' }}</h1>
            <p class="text-body-secondary mb-0">Semua kolom wajib diisi.</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('pendaftaran.daftar') }}" class="btn btn-outline-secondary">
                <svg class="ikon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg> Kembali
            </a>
        </div>
    </header>

    <form method="POST" action="{{ $pendaftaran->exists ? route('pendaftaran.perbarui', $pendaftaran) : route('pendaftaran.simpan') }}" class="card shadow-sm form-kartu">
        @csrf
        @if ($pendaftaran->exists)
            @method('PUT')
        @endif

        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong>Data belum dapat disimpan. Periksa kembali isian berikut:</strong>
                    <ul class="mt-1 mb-0">
                        @foreach ($errors->all() as $pesan)
                            <li>{{ $pesan }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <label for="pasien_id" class="form-label fw-semibold">Pasien</label>
                    <select id="pasien_id" name="pasien_id" @class(['form-select', 'is-invalid' => $errors->has('pasien_id')])>
                        <option value="" disabled @selected(old('pasien_id', $pendaftaran->pasien_id) === null)>Pilih pasien</option>
                        @foreach ($daftarPasien as $pasien)
                            <option value="{{ $pasien->id }}" @selected(old('pasien_id', $pendaftaran->pasien_id) == $pasien->id)>{{ $pasien->no_rm }} - {{ $pasien->nama }}</option>
                        @endforeach
                    </select>
                    @error('pasien_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="dokter_id" class="form-label fw-semibold">Dokter</label>
                    <select id="dokter_id" name="dokter_id" @class(['form-select', 'is-invalid' => $errors->has('dokter_id')])>
                        <option value="" disabled @selected(old('dokter_id', $pendaftaran->dokter_id) === null)>Pilih dokter</option>
                        @foreach ($daftarDokter as $dokter)
                            <option value="{{ $dokter->id }}" @selected(old('dokter_id', $pendaftaran->dokter_id) == $dokter->id)>{{ $dokter->nama }} - {{ $dokter->nama_spesialisasi }}</option>
                        @endforeach
                    </select>
                    @error('dokter_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="tanggal_daftar" class="form-label fw-semibold">Tanggal Daftar</label>
                    <input type="date" id="tanggal_daftar" name="tanggal_daftar" value="{{ old('tanggal_daftar', $pendaftaran->tanggal_daftar?->format('Y-m-d') ?? now()->format('Y-m-d')) }}" @class(['form-control', 'is-invalid' => $errors->has('tanggal_daftar')])>
                    @error('tanggal_daftar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 col-md-6">
                    <label for="status" class="form-label fw-semibold">Status</label>
                    <select id="status" name="status" @class(['form-select', 'is-invalid' => $errors->has('status')])>
                        <option value="" disabled @selected(old('status', $pendaftaran->status) === null)>Pilih status</option>
                        @foreach (App\Models\Pendaftaran::STATUS as $nilai => $teks)
                            <option value="{{ $nilai }}" @selected(old('status', $pendaftaran->status ?? 'Menunggu') == $nilai)>{{ $teks }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="keluhan" class="form-label fw-semibold">Keluhan</label>
                    <textarea id="keluhan" name="keluhan" rows="3" @class(['form-control', 'is-invalid' => $errors->has('keluhan')]) placeholder="Keluhan pasien">{{ old('keluhan', $pendaftaran->keluhan) }}</textarea>
                    @error('keluhan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card-footer bg-body-tertiary d-flex justify-content-end gap-2 px-4 py-3">
            <a href="{{ route('pendaftaran.daftar') }}" class="btn btn-outline-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
@endsection

