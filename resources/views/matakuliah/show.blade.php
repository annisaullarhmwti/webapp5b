@extends('layouts.app')

@section('title', 'Detail Mata Kuliah')

@section('content')
    <x-page-header
        judul="Detail Mata Kuliah"
        deskripsi="Informasi lengkap data mata kuliah." />

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            Informasi Mata Kuliah
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-sm-3 fw-semibold">Kode Mata Kuliah</div>
                <div class="col-sm-9">{{ $mataKuliah->kode_mk }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 fw-semibold">Nama Mata Kuliah</div>
                <div class="col-sm-9">{{ $mataKuliah->nama_mk }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 fw-semibold">Jumlah SKS</div>
                <div class="col-sm-9">{{ $mataKuliah->sks }} SKS</div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('matakuliah.index') }}"
                   class="btn btn-outline-secondary">
                    Kembali
                </a>

                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('matakuliah.edit', $mataKuliah) }}"
                       class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i> Ubah
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection