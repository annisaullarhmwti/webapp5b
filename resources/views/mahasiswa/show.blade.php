@extends('layouts.app')

@section('title', 'Detail Mahasiswa')

@section('content')
    <x-page-header
        judul="Detail Mahasiswa"
        deskripsi="Informasi mahasiswa berdasarkan NIM." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            Informasi Mahasiswa
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-sm-3 fw-semibold">NIM</div>
                <div class="col-sm-9">{{ $mahasiswa['nim'] }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 fw-semibold">Nama Lengkap</div>
                <div class="col-sm-9">{{ $mahasiswa['nama'] }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 fw-semibold">Angkatan</div>
                <div class="col-sm-9">{{ $mahasiswa['angkatan'] }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 fw-semibold">Email</div>
                <div class="col-sm-9">{{ $mahasiswa['email'] }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 fw-semibold">Status</div>
                <div class="col-sm-9">{{ $mahasiswa['status'] }}</div>
            </div>

            <a href="{{ route('mahasiswa.index') }}"
               class="btn btn-outline-secondary">
                Kembali ke Daftar Mahasiswa
            </a>
        </div>
    </div>
@endsection