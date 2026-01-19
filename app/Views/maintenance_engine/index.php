<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">Maintenance Engine</h3>

<!-- Alert -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif ?>

<!-- Button tambah -->

<div class="mb-3">
    <?php if (canCreate('maintenance')): ?>
    <a href="<?= base_url('maintenance-engine/create') ?>" class="btn btn-primary">
        + Tambah Maintenance
    </a>
    <?php endif; ?>
</div>

<!-- Table -->
<div class="card shadow-sm">
    <div class="card-body table-responsive">

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr class="text-center">
                    <th>No</th>
                    <th>Engine</th>
                    <th>Jenis Maintenance</th>
                    <th>HM Saat Maintenance</th>
                    <th>Interval HM</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th width="140">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data)): ?>
                    <?php $no = 1; foreach ($data as $row): ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= esc($row['nama_barang']) ?></td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    <?= esc($row['jenis_maintenance']) ?>
                                </span>
                            </td>
                            <td class="text-center"><?= number_format($row['hm_saat_maintenance'], 0) ?></td>
                            <td class="text-center"><?= number_format($row['interval_hm'], 0) ?></td>
                            <td class="text-center"><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                            <td><?= esc($row['keterangan']) ?></td>
                            <td class="text-center">
                                <?php if (canEdit('maintenance')): ?>
                                <a href="<?= base_url('maintenance-engine/edit/'.$row['id']) ?>"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>
                                <?php endif; ?>

                                <?php if (canDelete('maintenance')): ?>
                                <a href="<?= base_url('maintenance-engine/delete/'.$row['id']) ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin hapus data maintenance ini?')">
                                    Hapus
                                </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted">
                            Belum ada data maintenance
                        </td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>

    </div>
</div>

<?= $this->endSection() ?>
