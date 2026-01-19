<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h3>Tambah Budget Tahunan</h3>

<form action="/budget/store" method="post">
<?= csrf_field() ?>

<div class="row g-3">
    <div class="col-md-3">
        <label>Tahun</label>
        <input type="number" name="tahun" class="form-control" required>
    </div>

    <?php
    $fields = [
        'ton_tbs' => 'Ton TBS',
        'pome' => 'POME',
        'umpan_bioreaktor' => 'Umpan Bioreaktor',
        'produksi_biogas' => 'Produksi Biogas',
        'produksi_daya_listrik' => 'Produksi Daya Listrik',
        'ton_kernel' => 'Ton Kernel',
        'kwh_per_biogas' => 'kWh / Biogas',
        'biogas_per_pome' => 'Biogas / POME'
    ];
    ?>

    <?php foreach ($fields as $name => $label): ?>
    <div class="col-md-3">
        <label><?= $label ?></label>
        <input type="number" step="0.01" name="<?= $name ?>" class="form-control" value="0">
    </div>
    <?php endforeach ?>
</div>

<button class="btn btn-primary mt-3">Simpan</button>
<a href="/budget" class="btn btn-secondary mt-3">Kembali</a>

</form>

<?= $this->endSection() ?>
