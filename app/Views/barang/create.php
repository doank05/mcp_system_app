<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">Tambah Barang</h3>

<div class="card shadow-sm">
<div class="card-body">

<form action="/barang/save" method="post">

    <div class="mb-3">
        <label class="form-label">Kode Barang</label>
        <input type="text" name="kode_barang" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Nama Barang</label>
        <input type="text" name="nama_barang" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select name="kategori" class="form-select" required>
            <option value="mesin">Mesin</option>
            <option value="pompa">Pompa</option>
            <option value="panel">Panel</option>
            <option value="sensor">Sensor</option>
            <option value="engine">Engine</option>
            <option value="lainnya">Lainnya</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Lokasi</label>
        <input type="text" name="lokasi" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Bagian</label>
        <select name="bagian" class="form-select" required>
            <option value="engine_room">Engine Room</option>
            <option value="scrubber">Scrubber</option>
            <option value="bioreaktor">Bioreaktor</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Tanggal Pasang</label>
        <input type="date" name="tanggal_pasang" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Kondisi</label>
        <select name="kondisi" class="form-select" required>
            <option value="baik">Baik</option>
            <option value="perlu_perawatan">Perlu Perawatan</option>
            <option value="rusak">Rusak</option>
        </select>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="/barang" class="btn btn-secondary">Kembali</a>

</form>

</div>
</div>

<?= $this->endSection() ?>
