{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '_', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $namaAplikasi }} - Beranda</title>
</head>
<body>
    <h1>{{ $namaAplikasi }}</h1>
    <p>Konfigurasi berhasil. Hari ini {{$waktu}}.</p>

    <table border="1" cellpadding="6" cellspacing="0">
        <tr><th align="left">Laravel</th><td>{{ $versiLaravel }}</td></tr>
        <tr><th align="left">PHP</th><td>{{ $versiPhp }}</td></tr>
        <tr><th align="left">MySQL</th><td>{{ $versiMysql }}</td></tr>
        <tr><th align="left">Database</th><td>{{ $namaDatabase }}</td></tr>
    </table>
</body>
</html> --}}
@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <h1 class="mb-3">SIAKAD - <3202416024></h1>

    <p>
        Konfigurasi berhasil.
        Hari ini {{ now()->translatedFormat('l, d F Y H:i') }}.
    </p>

    <div class="card">
        <div class="card-body">
            <p>Laravel: {{ app()->version() }}</p>
            <p>PHP: {{ PHP_VERSION }}</p>
            <p>MySQL: 8.0.30</p>
            <p>Database: {{ config('database.connections.mysql.database') }}</p>
        </div>
    </div>
@endsection