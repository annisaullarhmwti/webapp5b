@extends('layouts.app')

@section('title', 'Detail KRS')

@section('content')
    <x-page-header
        judul="Detail KRS"
        deskripsi="Informasi lengkap Kartu Rencana Studi mahasiswa." />

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-body fw-semibold">
            Informasi KRS
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-sm-3 fw-semibold">NIM</div>
                <div class="col-sm-9">{{ $krs->mahasiswa->nim }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 fw-semibold">Nama Mahasiswa</div>
                <div class="col-sm-9">{{ $krs->mahasiswa->nama }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 fw-semibold">Tahun Akademik</div>
                <div class="col-sm-9">{{ $krs->tahun_akademik }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 fw-semibold">Semester</div>
                <div class="col-sm-9">{{ ucfirst($krs->semester) }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3 fw-semibold">Status</div>
                <div class="col-sm-9">{{ ucfirst($krs->status) }}</div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-body fw-semibold">
            Daftar Mata Kuliah
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Mata Kuliah</th>
                            <th>Nama Mata Kuliah</th>
                            <th>SKS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($krs->mataKuliah as $index => $mk)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $mk->kode_mk }}</td>
                                <td>{{ $mk->nama_mk }}</td>
                                <td>{{ $mk->sks }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    Belum ada mata kuliah yang dipilih.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">
                                Total SKS
                            </th>
                            <th>
                                {{ $krs->mataKuliah->sum('sks') }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('krs.index') }}"
                   class="btn btn-outline-secondary">
                    Kembali
                </a>

                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('krs.edit', $krs) }}"
                       class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i> Ubah
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection