<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">👥 Data Karyawan</h3>

<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<a href="/karyawan/create" class="btn btn-primary mb-3">
    + Tambah Karyawan
</a>

<div class="card shadow-sm">
<div class="card-body">

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark text-center">
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>TMK</th>
            <th width="160">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($karyawan as $k): ?>
        <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td><?= esc($k['nik']) ?></td>
            <td><?= esc($k['nama']) ?></td>
            <td class="text-capitalize"><?= esc($k['jabatan']) ?></td>
            <td><?= esc($k['tmk']) ?></td>
            <td class="text-center">
                <a href="/karyawan/edit/<?= $k['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="/karyawan/delete/<?= $k['id'] ?>"
                   onclick="return confirm('Hapus data ini?')"
                   class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

</div>
</div>

<?= $this->endSection() ?>
