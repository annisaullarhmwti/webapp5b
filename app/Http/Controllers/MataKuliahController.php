<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class MataKuliahController extends Controller
{
    public function index(): View
    {
        return view('matakuliah.index');
    }

    public function data(): JsonResponse
    {
        $query = MataKuliah::query()->select([
            'id', 'kode_mk', 'nama_mk', 'sks'
        ]);
        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('aksi', function (MataKuliah $mataKuliah) {
                return view('matakuliah._aksi', compact('mataKuliah'))->render();
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    public function create(): View
    {
        return view('matakuliah.create', [
            'mataKuliah' => new MataKuliah()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $mataKuliah = MataKuliah::create($this->validated($request));
        return redirect()
            ->route('matakuliah.index')
            ->with('success', 'Data mata kuliah ' . $mataKuliah->nama_mk . ' berhasil ditambahkan.');
    }

    public function show(MataKuliah $mata_kuliah): View
    {
        return view('matakuliah.show', [
            'mataKuliah' => $mata_kuliah
        ]);
    }

    public function edit(MataKuliah $mata_kuliah): View
    {
        return view('matakuliah.edit', [
            'mataKuliah' => $mata_kuliah
        ]);
    }

    public function update(Request $request, MataKuliah $mata_kuliah): RedirectResponse
    {
        $mata_kuliah->update($this->validated($request, $mata_kuliah));
        return redirect()
            ->route('matakuliah.index')
            ->with('success', 'Data mata kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $mata_kuliah): JsonResponse
    {
        try {
            $mata_kuliah->delete();
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Mata kuliah tidak dapat dihapus karena masih digunakan dalam KRS.'
            ], 409);
        }

        return response()->json([
            'message' => 'Data mata kuliah berhasil dihapus.'
        ]);
    }

    private function validated(
        Request $request,
        ?MataKuliah $mataKuliah = null
    ): array {
        return $request->validate([
            'kode_mk' => [
                'required',
                'string',
                'max:10',
                Rule::unique('mata_kuliah', 'kode_mk')->ignore($mataKuliah?->id)
            ],
            'nama_mk' => ['required', 'string', 'max:100'],
            'sks' => ['required', 'integer', 'min:1', 'max:255'],
        ], [
            'kode_mk.required' => 'Kode mata kuliah wajib diisi.',
            'kode_mk.unique' => 'Kode mata kuliah sudah digunakan.',
            'nama_mk.required' => 'Nama mata kuliah wajib diisi.',
            'sks.required' => 'Jumlah SKS wajib diisi.',
            'sks.integer' => 'SKS harus berupa angka.',
            'sks.min' => 'SKS minimal 1.',
        ]);
    }
}