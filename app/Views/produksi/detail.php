<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h4>Detail Produksi <?= date('d-m-Y', strtotime($row['tanggal'])) ?></h4>

<?php
    $produksi_biogas = $row['flare'] + $row['gas_out_scrubber'];

    // kWh / Biogas = listrik / gas_out_scrubber
    $kwh_per_biogas = $row['gas_out_scrubber'] > 0 
        ? $row['produksi_daya_listrik'] / $row['gas_out_scrubber'] 
        : 0;

    // Biogas / POME = biogas / umpan_bioreaktor
    $biogas_per_pome = $row['umpan_bioreaktor'] > 0 
        ? $produksi_biogas / $row['umpan_bioreaktor'] 
        : 0;
?>

<div class="card card-body mb-3">

<table class="table table-bordered">
    <tr><th>Ton TBS</th><td><?= number_format($row['ton_tbs_olah'],2) ?></td></tr>
    <tr><th>POME (Produced)</th><td><?= number_format($row['pome'],0) ?></td></tr>
    <tr><th>Umpan Bioreaktor</th><td><?= number_format($row['umpan_bioreaktor'],0) ?></td></tr>
    <tr><th>Flare</th><td><?= number_format($row['flare'],2) ?></td></tr>
    <tr><th>Gas Out Scrubber</th><td><?= number_format($row['gas_out_scrubber'],0) ?></td></tr>
    <tr><th>Produksi Biogas</th><td><?= number_format($produksi_biogas,0) ?></td></tr>
    <tr><th>Daya Listrik</th><td><?= number_format($row['produksi_daya_listrik'],0) ?></td></tr>
    <tr><th>Ton Kernel Olah</th><td><?= number_format($row['ton_kernel_olah'],0) ?></td></tr>

    <!-- RUMUS BARU -->
    <tr><th>kWh / Biogas</th><td><?= number_format($kwh_per_biogas,2) ?></td></tr>
    <tr><th>Biogas / POME</th><td><?= number_format($biogas_per_pome,2) ?></td></tr>
</table>

<h5 class="mt-4">Distribusi Power</h5>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Unit</th>
            <th>Daya Listrik</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($power as $p): ?>
        <tr>
            <td><?= esc($p['unit']) ?></td>
            <td><?= number_format($p['daya_listrik'],0) ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<a href="/produksi" class="btn btn-secondary">Kembali</a>

</div>

<?= $this->endSection() ?>
