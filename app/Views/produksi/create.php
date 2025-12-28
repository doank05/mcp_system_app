<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h4 class="mb-3">
    Input Produksi Harian Tahun <?= esc($tahun) ?>
</h4>

<form action="/produksi/store" method="post" class="card card-body shadow-sm">
<?= csrf_field() ?>

<div class="row g-3">

    <!-- Tanggal -->
    <div class="col-md-4">
        <label class="form-label">Tanggal Produksi</label>
        <input type="date" name="tanggal" class="form-control" required>
        <small class="text-muted">Tanggal tidak boleh duplikat</small>
    </div>

    <!-- Ton TBS Olah -->
    <div class="col-md-4">
        <label class="form-label">Ton TBS Olah</label>
        <input type="number" step="0.01" name="ton_tbs_olah"
               class="form-control" placeholder="0.00">
    </div>

    <!-- POME -->
    <div class="col-md-4">
        <label class="form-label">POME</label>
        <input type="number" step="0.01" name="pome"
               class="form-control" placeholder="0.00">
    </div>

    <!-- Umpan Bioreaktor -->
    <div class="col-md-4">
        <label class="form-label">Umpan Bioreaktor</label>
        <input type="number" step="0.01" name="umpan_bioreaktor"
               class="form-control" placeholder="0.00">
    </div>

    <!-- Produksi Biogas -->
    <div class="col-md-4">
        <label class="form-label">Produksi Biogas</label>
        <input type="number" step="0.01" name="produksi_biogas"
               class="form-control" placeholder="0.00">
    </div>

    <!-- Produksi Daya Listrik -->
    <div class="col-md-4">
        <label class="form-label">Produksi Daya Listrik</label>
        <input type="number" step="0.01" name="produksi_daya_listrik"
               class="form-control" placeholder="0.00">
    </div>

    <!-- Ton Kernel Olah -->
    <div class="col-md-4">
        <label class="form-label">Ton Kernel Olah</label>
        <input type="number" step="0.01" name="ton_kernel_olah"
               class="form-control" placeholder="0.00">
    </div>

    <!-- kWh / Biogas -->
    <div class="col-md-4">
        <label class="form-label">kWh / Biogas</label>
        <input type="number" step="0.01" name="kwh_per_biogas"
               class="form-control" placeholder="0.00">
    </div>

    <!-- Biogas / POME -->
    <div class="col-md-4">
        <label class="form-label">Biogas / POME</label>
        <input type="number" step="0.01" name="biogas_per_pome"
               class="form-control" placeholder="0.00">
    </div>

</div>

<hr class="my-4">

<div class="d-flex gap-2">
    <button class="btn btn-primary">
        💾 Simpan Produksi
    </button>
    <a href="/produksi" class="btn btn-secondary">
        ↩ Kembali
    </a>
</div>

</form>

<?= $this->endSection() ?>
