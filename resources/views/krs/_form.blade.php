<div class="row g-3">
    <div class="col-md-6">
        <label for="mahasiswa_id" class="form-label">
            Mahasiswa
        </label>

        <select id="mahasiswa_id" name="mahasiswa_id"
                class="form-select" required>
            <option value="">-- Pilih Mahasiswa --</option>

            @foreach ($mahasiswa as $mhs)
                <option value="{{ $mhs->id }}"
                    @selected(old('mahasiswa_id', $krs->mahasiswa_id) == $mhs->id)>
                    {{ $mhs->nim }} - {{ $mhs->nama }}
                </option>
            @endforeach
        </select>

        @error('mahasiswa_id')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <x-form-input label="Tahun Akademik"
            name="tahun_akademik"
            placeholder="Contoh: 2026/2027"
            :value="old('tahun_akademik', $krs->tahun_akademik)" />
    </div>

    <div class="col-md-6">
        <label for="semester" class="form-label">Semester</label>

        <select id="semester" name="semester"
                class="form-select" required>
            <option value="">-- Pilih Semester --</option>
            <option value="ganjil"
                @selected(old('semester', $krs->semester) === 'ganjil')>
                Ganjil
            </option>
            <option value="genap"
                @selected(old('semester', $krs->semester) === 'genap')>
                Genap
            </option>
        </select>

        @error('semester')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="status" class="form-label">Status KRS</label>

        <select id="status" name="status"
                class="form-select" required>
            <option value="draft"
                @selected(old('status', $krs->status ?? 'draft') === 'draft')>
                Draft
            </option>
            <option value="diajukan"
                @selected(old('status', $krs->status) === 'diajukan')>
                Diajukan
            </option>
            <option value="disetujui"
                @selected(old('status', $krs->status) === 'disetujui')>
                Disetujui
            </option>
            <option value="ditolak"
                @selected(old('status', $krs->status) === 'ditolak')>
                Ditolak
            </option>
        </select>

        @error('status')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="mata_kuliah" class="form-label">
            Pilih Mata Kuliah
        </label>

        <select id="mata_kuliah" name="mata_kuliah[]"
                class="form-select" multiple required>
            @foreach ($mataKuliah as $mk)
                <option value="{{ $mk->id }}"
                    @selected(
                        in_array(
                            $mk->id,
                            old('mata_kuliah', $krs->mataKuliah->pluck('id')->all() ?? [])
                        )
                    )>
                    {{ $mk->kode_mk }} - {{ $mk->nama_mk }}
                    ({{ $mk->sks }} SKS)
                </option>
            @endforeach
        </select>

        <div class="form-text">
            Tekan Ctrl sambil klik untuk memilih lebih dari satu mata kuliah.
        </div>

        @error('mata_kuliah')
            <div class="text-danger small">{{ $message }}</div>
        @enderror

        @error('mata_kuliah.*')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>
</div>