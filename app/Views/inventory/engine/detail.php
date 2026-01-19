<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h4 class="mb-4">⚙️ Engine Maintenance History</h4>

<!-- HEADER ENGINE -->
<div class="card mb-3 shadow-sm">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="text-muted small">ENGINE</div>
                <div class="fw-semibold">
                    <?= esc($barang['nama_barang'] ?? '-') ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small">KATEGORI</div>
                <div class="fw-semibold">
                    <?= esc($barang['kategori'] ?? '-') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TABLE MAINTENANCE -->
<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        Maintenance Records
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-secondary">
                <tr>
                    <th width="5%">No</th>
                    <th>Tanggal</th>
                    <th>Jenis Maintenance</th>
                    <th>HM</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>

            <?php if (!empty($maintenance)): ?>
                <?php $no = 1; foreach ($maintenance as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($row['tanggal']) ?></td>
                    <td><?= esc($row['jenis_maintenance']) ?></td>
                    <td><?= esc($row['hm_saat_maintenance']) ?></td>
                    <td><?= esc($row['keterangan'] ?? '-') ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        Belum ada data maintenance engine
                    </td>
                </tr>
            <?php endif; ?>

            </tbody>
        </table>
    </div>
</div>

<a href="/inventory/engine" class="btn btn-outline-secondary mt-4">
    ← Kembali
</a>

<?= $this->endSection() ?>
