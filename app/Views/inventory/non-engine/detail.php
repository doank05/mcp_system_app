<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h4 class="mb-4">🛠 Non Engine Maintenance History</h4>

<!-- HEADER BARANG -->
<div class="card mb-3 shadow-sm">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="text-muted small">BARANG</div>
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

<!-- TABLE NON ENGINE -->
<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        Maintenance Records
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-secondary">
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Pekerjaan</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Bagian</th>
                    <th>Status</th>
                    <th>Petugas</th>
                </tr>
            </thead>
            <tbody>

            <?php if (!empty($detailList)): ?>
                <?php $no = 1; foreach ($detailList as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($row['nama_pekerjaan']) ?></td>
                    <td><?= esc($row['tanggalMulai']) ?></td>
                    <td><?= esc($row['tanggalSelesai']) ?></td>
                    <td><?= esc($row['bagian'] ?? '-') ?></td>
                    <td class="text-uppercase">
                        <?= esc($row['status']) ?>
                    </td>
                    <td><?= esc($row['nama_karyawan'] ?? '-') ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        Belum ada data maintenance non engine
                    </td>
                </tr>
            <?php endif; ?>

            </tbody>
        </table>
    </div>
</div>

<a href="/inventory/non-engine" class="btn btn-outline-secondary mt-4">
    ← Kembali
</a>

<?= $this->endSection() ?>
