@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
    <x-page-header
        judul="Detail Mahasiswa"
        deskripsi="Informasi lengkap data mahasiswa." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            Informasi Mahasiswa
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-sm-3 fw-semibold">NIM</div>
                <div class="col-sm-9">{{ $mahasiswa->nim }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 fw-semibold">Nama Lengkap</div>
                <div class="col-sm-9">{{ $mahasiswa->nama }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 fw-semibold">Jenis Kelamin</div>
                <div class="col-sm-9">
                    {{ $mahasiswa->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 fw-semibold">Email</div>
                <div class="col-sm-9">{{ $mahasiswa->email }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 fw-semibold">Angkatan</div>
                <div class="col-sm-9">{{ $mahasiswa->angkatan }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 fw-semibold">Program Studi</div>
                <div class="col-sm-9">{{ $mahasiswa->program_studi }}</div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('mahasiswa.index') }}"
                   class="btn btn-outline-secondary">
                    Kembali
                </a>

                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('mahasiswa.edit', $mahasiswa) }}"
                       class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i> Ubah
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection