<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h4 class="mb-3">➕ Tambah Maintenance Non Engine</h4>

<?php if (session()->getFlashdata('error')): ?>
<div class="alert alert-danger">
    <?= session()->getFlashdata('error') ?>
</div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="/maintenance-non-engine/store" method="post">

            <div class="mb-3">
                <label class="form-label">Karyawan Bertugas</label>
                <select name="user_id" class="form-select" required>
                    <option value="">-- Pilih Karyawan --</option>
                    <?php foreach ($karyawan as $k): ?>
                        <option value="<?= $k['id'] ?>">
                            <?= esc($k['username']) ?> (<?= esc($k['nik']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Barang</label>
                <select name="idbarang" class="form-select" required>
                    <option value="">-- Pilih Barang --</option>
                    <?php foreach ($barang as $b): ?>
                        <option value="<?= $b['id'] ?>">
                            <?= esc($b['nama_barang']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Pekerjaan</label>
                <input type="text" name="nama_pekerjaan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3"></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Bagian</label>
                <input type="text" name="bagian" class="form-control">
            </div>

            <div class="mb-4">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="belum">Belum</option>
                <option value="pending">Pending</option>
                <option value="selesai">Selesai</option>
            </select>
            </div>


            <div class="d-flex justify-content-between">
                <a href="/maintenance-non-engine" class="btn btn-secondary">
                    ← Kembali
                </a>
                <button type="submit" class="btn btn-success">
                    💾 Simpan
                </button>
            </div>

        </form>

    </div>
</div>

<?= $this->endSection() ?>
