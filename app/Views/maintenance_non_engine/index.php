<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">🛠 Maintenance Non Engine</h4>
    <a href="/maintenance-non-engine/create" class="btn btn-primary">
        + Tambah Maintenance
    </a>
</div>

<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success">
    <?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Barang</th>
                    <th>Nama Pekerjaan</th>
                    <th>Karyawan</th>
                    <th>Periode</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($data)): ?>
                <?php $no = 1; foreach ($data as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($row['nama_barang'] ?? '-') ?></td>
                    <td><?= esc($row['nama_pekerjaan']) ?></td>
                    <td><?= esc($row['username']) ?></td>
                    <td>
                        <?= esc($row['tanggal_mulai']) ?>
                        <br>
                        <small class="text-muted">s/d <?= esc($row['tanggal_selesai']) ?></small>
                    </td>
                    <td>
                        <?php if ($row['status'] === 'selesai'): ?>
                        <span class="badge bg-success">Selesai</span>
                        <?php elseif ($row['status'] === 'pending'): ?>
                            <span class="badge bg-warning text-dark">Pending</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Belum</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="/maintenance-non-engine/edit/<?= $row['id'] ?>"
                        class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <a href="/maintenance-non-engine/delete/<?= $row['id'] ?>"
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('Yakin hapus data ini?')">
                            Hapus
                        </a>
                    </td>

                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Belum ada data maintenance non engine
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
