<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h3>Pengaturan Tahun Aktif</h3>

<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success">
    <?= session()->getFlashdata('success') ?>
</div>
<?php endif ?>

<form action="/tahun-aktif/store" method="post" class="mb-3">
<?= csrf_field() ?>
<div class="row g-2">
    <div class="col-md-3">
        <input type="number" name="tahun" class="form-control" placeholder="2026" required>
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary">Tambah Tahun</button>
    </div>
</div>
</form>

<table class="table table-bordered">
<thead>
<tr>
    <th>Tahun</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php foreach ($data as $d): ?>
<tr>
    <td><?= $d['tahun'] ?></td>
    <td>
        <?= $d['is_active'] ? '<span class="badge bg-success">Aktif</span>' : '-' ?>
    </td>
    <td>
        <?php if (!$d['is_active']): ?>
        <form action="/tahun-aktif/set" method="post" style="display:inline">
            <?= csrf_field() ?>
            <input type="hidden" name="tahun" value="<?= $d['tahun'] ?>">
            <button type="submit" class="btn btn-sm btn-warning">
                Aktifkan
            </button>
        </form>
        <?php endif ?>
    </td>
</tr>
<?php endforeach ?>
</tbody>
</table>

<?= $this->endSection() ?>
