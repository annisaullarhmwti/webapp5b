<div class="row g-3">
    <div class="col-md-4">
        <x-form-input label="Kode Mata Kuliah" name="kode_mk"
            :value="old('kode_mk', $mataKuliah->kode_mk)" />
    </div>

    <div class="col-md-8">
        <x-form-input label="Nama Mata Kuliah" name="nama_mk"
            :value="old('nama_mk', $mataKuliah->nama_mk)" />
    </div>

    <div class="col-md-4">
        <x-form-input label="Jumlah SKS" name="sks" type="number"
            :value="old('sks', $mataKuliah->sks)" />
    </div>
</div>