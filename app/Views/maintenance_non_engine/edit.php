<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h4 class="mb-3">✏️ Edit Maintenance Non Engine</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="/maintenance-non-engine/update/<?= $row['id'] ?>" method="post">

            <div class="mb-3">
                <label class="form-label">Barang</label>
                <select name="idbarang" class="form-select" required>
                    <?php foreach ($barang as $b): ?>
                        <option value="<?= $b['id'] ?>"
                            <?= $b['id'] == $row['idbarang'] ? 'selected' : '' ?>>
                            <?= esc($b['nama_barang']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Pekerjaan</label>
                <input type="text"
                       name="nama_pekerjaan"
                       class="form-control"
                       value="<?= esc($row['nama_pekerjaan']) ?>"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi"
                          class="form-control"
                          rows="3"><?= esc($row['deskripsi']) ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date"
                           name="tanggalMulai"
                           class="form-control"
                           value="<?= esc($row['tanggalMulai']) ?>"
                           required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date"
                           name="tanggalSelesai"
                           class="form-control"
                           value="<?= esc($row['tanggalSelesai']) ?>"
                           required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Bagian</label>
                <input type="text"
                       name="bagian"
                       class="form-control"
                       value="<?= esc($row['bagian']) ?>">
            </div>

            <div class="mb-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="belum"   <?= $row['status']=='belum' ? 'selected' : '' ?>>Belum</option>
                    <option value="pending" <?= $row['status']=='pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="selesai" <?= $row['status']=='selesai' ? 'selected' : '' ?>>Selesai</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="/maintenance-non-engine" class="btn btn-secondary">
                    ← Kembali
                </a>
                <button class="btn btn-success">
                    💾 Update
                </button>
            </div>

        </form>

    </div>
</div>

<?= $this->endSection() ?>
