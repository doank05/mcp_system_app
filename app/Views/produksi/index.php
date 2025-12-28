<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h3 class="mb-3">
    Data Produksi Harian Tahun <?= esc($tahun) ?>
</h3>

<a href="/produksi/create" class="btn btn-primary mb-3">
    + Input Produksi
</a>

<?php if (session()->getFlashdata('success')): ?>
<div class="alert alert-success">
    <?= session()->getFlashdata('success') ?>
</div>
<?php endif ?>

<div class="card shadow-sm">
<div class="card-body table-responsive">
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

<div class="table-responsive">
<table class="table table-bordered table-striped align-middle">
    <thead class="table-light text-center">
        <tr>
            <th width="50">No</th>
            <th>Tanggal</th>
            <th>Ton TBS</th>
            <th>POME</th>
            <th>Umpan Bio</th>
            <th>Biogas</th>
            <th>Daya Listrik</th>
            <th>Kernel</th>
            <th>kWh/Biogas</th>
            <th>Biogas/POME</th>
            <th width="130">Aksi</th>
        </tr>
    </thead>

    <tbody>
    <?php if (!empty($data)): ?>

        <?php
            // Nomor urut aman walau pagination berubah
            $perPage = $pager ? $pager->getPerPage() : count($data);
            $currentPage = $pager ? $pager->getCurrentPage() : 1;
            $no = 1 + ($perPage * ($currentPage - 1));
        ?>

        <?php foreach ($data as $d): ?>
        <tr>
            <td class="text-center"><?= $no++ ?></td>
            <td class="text-center">
                <?= date('d-m-Y', strtotime($d['tanggal'])) ?>
            </td>
            <td><?= number_format($d['ton_tbs_olah'], 2) ?></td>
            <td><?= number_format($d['pome'], 2) ?></td>
            <td><?= number_format($d['umpan_bioreaktor'], 2) ?></td>
            <td><?= number_format($d['produksi_biogas'], 2) ?></td>
            <td><?= number_format($d['produksi_daya_listrik'], 2) ?></td>
            <td><?= number_format($d['ton_kernel_olah'], 2) ?></td>
            <td><?= number_format($d['kwh_per_biogas'], 2) ?></td>
            <td><?= number_format($d['biogas_per_pome'], 2) ?></td>

            <td class="text-center">
                <a href="/produksi/edit/<?= $d['id'] ?>"
                   class="btn btn-warning btn-sm">
                    Edit
                </a>

                <a href="/produksi/delete/<?= $d['id'] ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin hapus data produksi ini?')">
                    Hapus
                </a>
            </td>
        </tr>
        <?php endforeach ?>

    <?php else: ?>
        <tr>
            <td colspan="11" class="text-center text-muted py-3">
                Belum ada data produksi
            </td>
        </tr>
    <?php endif ?>
    </tbody>
</table>
</div>


<div class="mt-3 d-flex justify-content-center">
    <?= $pager->links('default', 'bootstrap') ?>
</div>


</div>
</div>

<?= $this->endSection() ?>
