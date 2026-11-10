<div class="row g-3">
    <div class="col-md-4">
        <x-form-input label="NIM" name="nim"
            :value="old('nim', $mahasiswa->nim)" />
    </div>

    <div class="col-md-8">
        <x-form-input label="Nama Lengkap" name="nama"
            :value="old('nama', $mahasiswa->nama)" />
    </div>

    <div class="col-md-6">
        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
        <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
            <option value="">-- Pilih Jenis Kelamin --</option>
            <option value="L" @selected(old('jenis_kelamin', $mahasiswa->jenis_kelamin) === 'L')>
                Laki-laki
            </option>
            <option value="P" @selected(old('jenis_kelamin', $mahasiswa->jenis_kelamin) === 'P')>
                Perempuan
            </option>
        </select>
        @error('jenis_kelamin')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <x-form-input label="Email" name="email" type="email"
            :value="old('email', $mahasiswa->email)" />
    </div>

    <div class="col-md-4">
        <x-form-input label="Angkatan" name="angkatan" type="number"
            :value="old('angkatan', $mahasiswa->angkatan)" />
    </div>

    <div class="col-md-8">
        <x-form-input label="Program Studi" name="program_studi"
            :value="old('program_studi', $mahasiswa->program_studi)" />
    </div>
</div>