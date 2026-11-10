<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class KrsController extends Controller
{
    public function index(): View
    {
        return view('krs.index');
    }

    public function data(): JsonResponse
    {
        $query = Krs::select('krs.*')
            ->with('mahasiswa')
            ->withSum('mataKuliah as total_sks', 'sks');

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('nim', function (Krs $krs) {
                return $krs->mahasiswa->nim;
            })
            ->addColumn('nama', function (Krs $krs) {
                return $krs->mahasiswa->nama;
            })
            ->addColumn('aksi', function (Krs $krs) {
                return view('krs._aksi', compact('krs'))->render();
            })
            ->editColumn('semester', function (Krs $krs) {
                return ucfirst($krs->semester);
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create(): View
    {
        return view('krs.create', [
            'krs' => new Krs(),
            'mahasiswa' => Mahasiswa::orderBy('nama')->get(),
            'mataKuliah' => MataKuliah::orderBy('nama_mk')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        DB::transaction(function () use ($validated) {
            $krs = Krs::create([
                'mahasiswa_id' => $validated['mahasiswa_id'],
                'tahun_akademik' => $validated['tahun_akademik'],
                'semester' => $validated['semester'],
                'status' => $validated['status'],
            ]);

            $krs->krsDetail()->createMany(
                collect($validated['mata_kuliah'])
                    ->map(fn ($id) => ['mata_kuliah_id' => $id])
                    ->all()
            );
        });

        return redirect()
            ->route('krs.index')
            ->with('success', 'Data KRS berhasil ditambahkan.');
    }

    public function show(Krs $kr): View
    {
        $kr->load(['mahasiswa', 'mataKuliah']);

        return view('krs.show', ['krs' => $kr]);
    }

    public function edit(Krs $kr): View
    {
        $kr->load('mataKuliah');

        return view('krs.edit', [
            'krs' => $kr,
            'mahasiswa' => Mahasiswa::orderBy('nama')->get(),
            'mataKuliah' => MataKuliah::orderBy('nama_mk')->get(),
        ]);
    }

    public function update(Request $request, Krs $kr): RedirectResponse
    {
        $validated = $this->validated($request);

        DB::transaction(function () use ($validated, $kr) {
            $kr->update([
                'mahasiswa_id' => $validated['mahasiswa_id'],
                'tahun_akademik' => $validated['tahun_akademik'],
                'semester' => $validated['semester'],
                'status' => $validated['status'],
            ]);

            $kr->krsDetail()->delete();

            $kr->krsDetail()->createMany(
                collect($validated['mata_kuliah'])
                    ->map(fn ($id) => ['mata_kuliah_id' => $id])
                    ->all()
            );
        });

        return redirect()
            ->route('krs.index')
            ->with('success', 'Data KRS berhasil diperbarui.');
    }

    public function destroy(Krs $kr): JsonResponse
    {
        try {
            $kr->delete();
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Data KRS tidak dapat dihapus.'
            ], 409);
        }

        return response()->json([
            'message' => 'Data KRS berhasil dihapus.'
        ]);
    }

    private function validated(Request $request): array
    {
        
        $validated = $request->validate([
            'mahasiswa_id' => [
                'required',
                'exists:mahasiswa,id',
            ],
            'tahun_akademik' => [
                'required',
                'string',
                'regex:/^\d{4}\/\d{4}$/',
            ],
            'semester' => [
                'required',
                Rule::in(['ganjil', 'genap']),
            ],
            'status' => [
                'required',
                Rule::in(['draft', 'diajukan', 'disetujui', 'ditolak']),
            ],
            'mata_kuliah' => [
                'required',
                'array',
                'min:1',
            ],
            'mata_kuliah.*' => [
                'required',
                'distinct',
                'exists:mata_kuliah,id',
            ],
        ], [
            'mahasiswa_id.required' => 'Mahasiswa wajib dipilih.',
            'mahasiswa_id.exists' => 'Mahasiswa tidak ditemukan.',
            'tahun_akademik.required' => 'Tahun akademik wajib diisi.',
            'tahun_akademik.regex' => 'Format tahun akademik harus YYYY/YYYY.',
            'semester.required' => 'Semester wajib dipilih.',
            'mata_kuliah.required' => 'Mata kuliah wajib dipilih.',
            'mata_kuliah.min' => 'Pilih minimal satu mata kuliah.',
            'mata_kuliah.*.distinct' => 'Mata kuliah tidak boleh dipilih dua kali.',
            'mata_kuliah.*.exists' => 'Mata kuliah tidak ditemukan.',
        ]);

        // Menghitung total SKS mata kuliah yang dipilih
        $totalSks = MataKuliah::whereIn(
            'id',
            $validated['mata_kuliah']
        )->sum('sks');

        // Memeriksa batas maksimal 24 SKS
        if ($totalSks > 24) {
            throw ValidationException::withMessages([
                'mata_kuliah' => 'Total SKS tidak boleh lebih dari 24 SKS.',
            ]);
        }

        return $validated;
    }
}