<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function index(): View
    {
        $versiMySQL = DB::selectOne('select version() as versi')->versi;

        return view('beranda', [
            'namaAplikasi' => config('app.name'),
            'versiLaravel' => app()->version(),
            'versiPhp'     => PHP_VERSION,
            'versiMysql'   => $versiMySQL,
            'namaDatabase' => DB::getDatabaseName(),
            'waktu'        => now()->translatedFormat('l, d F Y H:i'),
        ]);
    }
}
