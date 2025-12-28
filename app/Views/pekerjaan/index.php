<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">Data Pekerjaan</h3>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<a href="/pekerjaan/create" class="btn btn-primary mb-3">
    + Tambah Pekerjaan
</a>

<div class="card shadow-sm">
    <div class="card-body">

        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pekerjaan</th>
                    <th>Deskripsi</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Bagian</th>
                    <th>NIK Karyawan</th>
                    <th>Status</th>
                    <th width="150" class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $no = 1; foreach ($pekerjaan as $p): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($p['nama_pekerjaan']) ?></td>
                    <td><?= esc($p['deskripsi']) ?></td>
                    <td><?= esc($p['tanggalMulai']) ?></td>
                    <td><?= esc($p['tanggalSelesai']) ?></td>
                    <td><?= esc($p['bagian']) ?></td>
                    <td><?= esc($p['nikKaryawan']) ?></td>
                    <td><?= esc($p['status']) ?></td>
                    <td class="text-center">
                        <a href="/pekerjaan/edit/<?= $p['id'] ?>" 
                           class="btn btn-warning btn-sm">
                           Edit
                        </a>

                        <a href="/pekerjaan/delete/<?= $p['id'] ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Hapus data ini?')">
                           Hapus
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>

    </div>
</div>

<?= $this->endSection() ?>
