@extends('layouts.app')

@section('title', 'Akses Ditolak')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-sm text-center">
                    <div class="card-body p-5">
                        <i class="bi bi-shield-lock display-1 text-danger"></i>

                        <h1 class="display-4 fw-bold text-danger mt-3">403</h1>
                        <h2 class="h4 mb-3">Akses Ditolak</h2>

                        <p class="text-body-secondary">
                            Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.
                        </p>

                        <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">
                            <i class="bi bi-house-door me-1"></i>
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection