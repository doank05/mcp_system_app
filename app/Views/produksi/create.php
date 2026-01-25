<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h4 class="mb-3">
    Input Produksi Harian Tahun <?= esc($tahun) ?>
</h4>

<form action="/produksi/store" method="post" class="card card-body shadow-sm">
<?= csrf_field() ?>

<div class="row g-3">

<div class="col-md-4">
    <label class="form-label">Tanggal Produksi</label>
    <input type="date" name="tanggal" class="form-control" required>
</div>

<div class="col-md-4">
    <label class="form-label">Ton TBS Olah</label>
    <input type="number" step="0.01" name="ton_tbs_olah" class="form-control">
</div>

<div class="col-md-4">
    <label class="form-label">POME</label>
    <input type="number" step="0.01" name="pome" class="form-control">
</div>

<div class="col-md-4">
    <label class="form-label">Umpan Bioreaktor</label>
    <input type="number" step="0.01" name="umpan_bioreaktor" class="form-control">
</div>

<div class="col-md-4">
    <label class="form-label">Flare</label>
    <input type="number" step="0.01" name="flare" class="form-control">
</div>

<div class="col-md-4">
    <label class="form-label">Gas Out Scrubber</label>
    <input type="number" step="0.01" name="gas_out_scrubber" class="form-control">
</div>

<div class="col-md-4">
    <label class="form-label">Produksi Daya Listrik</label>
    <input type="number" step="0.01" name="produksi_daya_listrik" class="form-control">
</div>

<div class="col-md-4">
    <label class="form-label">Ton Kernel Olah</label>
    <input type="number" step="0.01" name="ton_kernel_olah" class="form-control">
</div>

<hr class="my-3">

<h6>Distribusi Power</h6>

<div class="col-md-4"><label>KCP</label><input type="number" step="0.01" name="kcp" class="form-control"></div>
<div class="col-md-4"><label>PKS Gateng</label><input type="number" step="0.01" name="pks_gateng" class="form-control"></div>
<div class="col-md-4"><label>MCP</label><input type="number" step="0.01" name="mcp" class="form-control"></div>
<div class="col-md-4"><label>Estate</label><input type="number" step="0.01" name="estate" class="form-control"></div>
<div class="col-md-4"><label>Granul</label><input type="number" step="0.01" name="granul" class="form-control"></div>

</div>

<hr class="my-4">

<div class="d-flex gap-2">
    <button class="btn btn-primary">💾 Simpan Produksi</button>
    <a href="/produksi" class="btn btn-secondary">↩ Kembali</a>
</div>

</form>
<?= $this->endSection() ?>
