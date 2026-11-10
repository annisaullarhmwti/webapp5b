<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalKrs = Krs::count();
        $totalDisetujui = Krs::where('status', 'disetujui')->count();

        $statistik = [
            [
                'judul' => 'Mahasiswa',
                'jumlah' => Mahasiswa::count(),
                'ikon' => 'bi-mortarboard-fill',
                'warna' => 'primary'
            ],
            [
                'judul' => 'Mata Kuliah',
                'jumlah' => MataKuliah::count(),
                'ikon' => 'bi-book-fill',
                'warna' => 'warning'
            ],
            [
                'judul' => 'Total KRS',
                'jumlah' => $totalKrs,
                'ikon' => 'bi-journal-check',
                'warna' => 'info'
            ],
            [
                'judul' => 'KRS Disetujui',
                'jumlah' => $totalDisetujui,
                'ikon' => 'bi-check-circle-fill',
                'warna' => 'success'
            ],
        ];

        $kolomkrs = [
            'nim' => 'NIM',
            'nama' => 'Nama Mahasiswa',
            'sks' => 'SKS',
            'status' => 'Status',
        ];

        $krsTerbaru = Krs::with(['mahasiswa', 'mataKuliah'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($krs) {
                return [
                    'nim' => $krs->mahasiswa->nim,
                    'nama' => $krs->mahasiswa->nama,
                    'sks' => $krs->mataKuliah->sum('sks'),
                    'status' => ucfirst($krs->status),
                ];
            });

        $statuskrs = [
            ['label' => 'Disetujui', 'status' => 'disetujui', 'warna' => 'success'],
            ['label' => 'Diajukan', 'status' => 'diajukan', 'warna' => 'warning'],
            ['label' => 'Draft', 'status' => 'draft', 'warna' => 'secondary'],
            ['label' => 'Ditolak', 'status' => 'ditolak', 'warna' => 'danger'],
        ];

        $statuskrs = collect($statuskrs)->map(function ($item) use ($totalKrs) {
            $jumlah = Krs::where('status', $item['status'])->count();

            $item['persen'] = $totalKrs > 0
                ? round(($jumlah / $totalKrs) * 100)
                : 0;

            return $item;
        });

        return view('dashboard', compact(
            'statistik',
            'kolomkrs',
            'krsTerbaru',
            'statuskrs'
        ));
    }
}