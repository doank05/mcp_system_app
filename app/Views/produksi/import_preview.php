<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h4>Preview Import Produksi (Tahun <?= $tahun ?>)</h4>

<form action="/produksi/import-save" method="post">
<?= csrf_field() ?>

<div class="table-responsive">
<table class="table table-bordered table-sm">
<thead class="table-light">
<tr>
    <th>Tanggal</th>
    <th>TBS</th>
    <th>POME</th>
    <th>Umpan</th>
    <th>Biogas</th>
    <th>Listrik</th>
    <th>Kernel</th>
    <th>kWh/Biogas</th>
    <th>Biogas/POME</th>
</tr>
</thead>
<tbody>
<?php foreach ($preview as $p): ?>
<tr>
    <td><?= $p['tanggal'] ?></td>
    <td><?= $p['ton_tbs_olah'] ?></td>
    <td><?= $p['pome'] ?></td>
    <td><?= $p['umpan_bioreaktor'] ?></td>
    <td><?= $p['produksi_biogas'] ?></td>
    <td><?= $p['produksi_daya_listrik'] ?></td>
    <td><?= $p['ton_kernel_olah'] ?></td>
    <td><?= $p['kwh_per_biogas'] ?></td>
    <td><?= $p['biogas_per_pome'] ?></td>
</tr>
<?php endforeach ?>
</tbody>
</table>
</div>

<div class="mt-3 d-flex gap-2">
    <button class="btn btn-primary">Simpan Semua</button>
    <a href="/produksi" class="btn btn-secondary">Batal</a>
</div>

</form>

<?= $this->endSection() ?>
