<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h4 class="mb-3">Edit Produksi (<?= date('d-m-Y', strtotime($row['tanggal'])) ?>)</h4>

<form action="/produksi/update/<?= $row['id'] ?>" method="post" class="card card-body shadow-sm">
<?= csrf_field() ?>

<div class="row g-3">

<div class="col-md-6">
    <label class="form-label">Ton TBS Olah</label>
    <input type="number" step="0.01" name="ton_tbs_olah"
           value="<?= esc($row['ton_tbs_olah']) ?>" class="form-control">
</div>

<div class="col-md-6">
    <label class="form-label">POME</label>
    <input type="number" step="0.01" name="pome"
           value="<?= esc($row['pome']) ?>" class="form-control">
</div>

<div class="col-md-6">
    <label class="form-label">Umpan Bioreaktor</label>
    <input type="number" step="0.01" name="umpan_bioreaktor"
           value="<?= esc($row['umpan_bioreaktor']) ?>" class="form-control">
</div>

<div class="col-md-6">
    <label class="form-label">Produksi Biogas</label>
    <input type="number" step="0.01" name="produksi_biogas"
           value="<?= esc($row['produksi_biogas']) ?>" class="form-control">
</div>

<div class="col-md-6">
    <label class="form-label">Produksi Daya Listrik</label>
    <input type="number" step="0.01" name="produksi_daya_listrik"
           value="<?= esc($row['produksi_daya_listrik']) ?>" class="form-control">
</div>

<div class="col-md-6">
    <label class="form-label">Ton Kernel Olah</label>
    <input type="number" step="0.01" name="ton_kernel_olah"
           value="<?= esc($row['ton_kernel_olah']) ?>" class="form-control">
</div>

<div class="col-md-6">
    <label class="form-label">kWh / Biogas</label>
    <input type="number" step="0.01" name="kwh_per_biogas"
           value="<?= esc($row['kwh_per_biogas']) ?>" class="form-control">
</div>

<div class="col-md-6">
    <label class="form-label">Biogas / POME</label>
    <input type="number" step="0.01" name="biogas_per_pome"
           value="<?= esc($row['biogas_per_pome']) ?>" class="form-control">
</div>

</div>

<div class="mt-4 d-flex gap-2">
    <button class="btn btn-primary">Update</button>
    <a href="/produksi" class="btn btn-secondary">Kembali</a>
</div>

</form>

<?= $this->endSection() ?>