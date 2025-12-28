<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">Tambah Pekerjaan</h3>

<div class="card shadow-sm">
<div class="card-body">

<form action="/pekerjaan/save" method="post">

    <div class="mb-3">
        <label>Nama Pekerjaan</label>
        <input type="text" name="nama_pekerjaan" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control"></textarea>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggalMulai" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            <label>Tanggal Selesai</label>
            <input type="date" name="tanggalSelesai" class="form-control" required>
        </div>
    </div>

    <div class="mb-3">
        <label>Bagian</label>
        <select name="bagian" class="form-select" required>
            <option value="engine_room">Engine Room</option>
            <option value="scrubber">Scrubber</option>
            <option value="bioreaktor">Bioreaktor</option>
        </select>
    </div>

    <!-- BARANG -->
    <div class="mb-3">
        <label>Barang</label>
        <select name="barang_id" class="form-select" required>
            <?php foreach ($barang as $b): ?>
                <option value="<?= $b['id'] ?>">
                    <?= esc($b['nama_barang']) ?> (<?= $b['kode_barang'] ?>)
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <!-- USER -->
    <div class="mb-3">
        <label>Penanggung Jawab</label>
        <select name="nikKaryawan" class="form-select" required>
            <?php foreach ($users as $u): ?>
                <option value="<?= $u['nik'] ?>">
                    <?= esc($u['nama']) ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-select">
            <option value="pending">Pending</option>
            <option value="progress">Progress</option>
            <option value="selesai">Selesai</option>
        </select>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="/pekerjaan" class="btn btn-secondary">Kembali</a>
</form>
</div>
</div>

<?= $this->endSection() ?>
