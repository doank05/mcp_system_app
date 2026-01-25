<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h3 class="mb-3">
    Data Produksi Harian Tahun <?= esc($tahun) ?>
</h3>

<?php if (canCreate('produksi')): ?>
    <a href="/produksi/create" class="btn btn-primary mb-3">
        + Tambah Produksi
    </a>
<?php endif; ?>

<?php if (canCreate('produksi')): ?>
<form action="/produksi/import" method="post" enctype="multipart/form-data"
      class="card card-body mb-3">
<?= csrf_field() ?>

<div class="row g-3 align-items-end">
    <div class="col-md-5">
        <label class="form-label">Upload Excel Produksi</label>
        <input type="file" name="file_excel"
               class="form-control"
               accept=".xls,.xlsx,.csv"
               required>
    </div>

    <div class="col-md-3">
        <button class="btn btn-success w-100">
            Import & Preview
        </button>
    </div>
</div>
</form>
<?php endif; ?>


<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success">
    <?= session()->getFlashdata('success') ?>
</div>
<?php endif ?>

<?php if (!empty($missingDates)): ?>
<div class="alert alert-warning">
    <strong>⚠ Data produksi belum diinput untuk tanggal:</strong><br>
    <?= implode(', ', array_map(function($d){
        return date('d-m-Y', strtotime($d));
    }, $missingDates)) ?>
</div>
<?php endif; ?>


<table class="table table-bordered table-striped align-middle">
<thead class="table-light text-center">
<tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Biogas</th>
    <th>Daya Listrik</th>
    <th>kWh/Biogas</th>
    <th>Biogas/POME</th>
    <th width="200">Aksi</th>
</tr>
</thead>

<tbody>
<?php
$perPage = $pager ? $pager->getPerPage() : count($data);
$currentPage = $pager ? $pager->getCurrentPage() : 1;
$no = 1 + ($perPage * ($currentPage - 1));
?>

<?php foreach ($data as $d): ?>
<?php
$biogas = $d['flare'] + $d['gas_out_scrubber'];
$kwh = $biogas > 0 ? $d['produksi_daya_listrik'] / $d['gas_out_scrubber'] : 0;
$ratio = $d['umpan_bioreaktor'] > 0 ? $biogas / $d['umpan_bioreaktor'] : 0;
?>
<tr>
    <td class="text-center"><?= $no++ ?></td>
    <td class="text-center"><?= date('d-m-Y', strtotime($d['tanggal'])) ?></td>
    <td><?= number_format($biogas,2) ?></td>
    <td><?= number_format($d['produksi_daya_listrik'],2) ?></td>
    <td><?= number_format($kwh,2) ?></td>
    <td><?= number_format($ratio,2) ?></td>
    <td class="text-center">
        <a href="/produksi/detail/<?= $d['id'] ?>" class="btn btn-info btn-sm">Detail</a>

        <?php if (canEdit('produksi')): ?>
        <a href="/produksi/edit/<?= $d['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <?php endif; ?>

        <?php if (canDelete('produksi')): ?>
        <a href="/produksi/delete/<?= $d['id'] ?>" class="btn btn-danger btn-sm"
           onclick="return confirm('Yakin hapus data produksi ini?')">Hapus</a>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach ?>
</tbody>
</table>

<div class="mt-3 d-flex justify-content-center">
    <?= $pager->links('default', 'bootstrap') ?>
</div>

<?= $this->endSection() ?>
