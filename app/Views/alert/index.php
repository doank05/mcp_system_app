<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h3 class="mb-3">Alert & Notification</h3>

<a href="/alert/create" class="btn btn-primary mb-3">+ Tambah Alert</a>

<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif ?>

<div class="card shadow-sm">
<div class="card-body table-responsive">

<table class="table table-bordered">
<thead>
<tr>
  <th>Judul</th>
  <th>Tipe</th>
  <th>Status</th>
  <th width="150">Aksi</th>
</tr>
</thead>
<tbody>
<?php foreach ($data as $d): ?>
<tr>
  <td><?= esc($d['judul']) ?></td>
  <td><span class="badge bg-<?= $d['tipe'] ?>"><?= $d['tipe'] ?></span></td>
  <td><?= $d['is_active'] ? 'Aktif' : 'Nonaktif' ?></td>
  <td>
    <a href="/alert/edit/<?= $d['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
    <a href="/alert/delete/<?= $d['id'] ?>" class="btn btn-danger btn-sm"
       onclick="return confirm('Hapus alert ini?')">Hapus</a>
  </td>
</tr>
<?php endforeach ?>
</tbody>
</table>

</div>
</div>

<?= $this->endSection() ?>
