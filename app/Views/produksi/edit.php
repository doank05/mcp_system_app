<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h4 class="mb-3">Edit Produksi (<?= date('d-m-Y', strtotime($row['tanggal'])) ?>)</h4>

<form action="/produksi/update/<?= $row['id'] ?>" method="post" class="card card-body shadow-sm">
<?= csrf_field() ?>

<div class="row g-3">

<div class="col-md-4"><label>Ton TBS</label><input type="number" step="0.01" name="ton_tbs_olah" value="<?= esc($row['ton_tbs_olah']) ?>" class="form-control"></div>
<div class="col-md-4"><label>POME</label><input type="number" step="0.01" name="pome" value="<?= esc($row['pome']) ?>" class="form-control"></div>
<div class="col-md-4"><label>Umpan</label><input type="number" step="0.01" name="umpan_bioreaktor" value="<?= esc($row['umpan_bioreaktor']) ?>" class="form-control"></div>
<div class="col-md-4"><label>Flare</label><input type="number" step="0.01" name="flare" value="<?= esc($row['flare']) ?>" class="form-control"></div>
<div class="col-md-4"><label>Gas Out</label><input type="number" step="0.01" name="gas_out_scrubber" value="<?= esc($row['gas_out_scrubber']) ?>" class="form-control"></div>
<div class="col-md-4"><label>Daya Listrik</label><input type="number" step="0.01" name="produksi_daya_listrik" value="<?= esc($row['produksi_daya_listrik']) ?>" class="form-control"></div>
<div class="col-md-4"><label>Kernel</label><input type="number" step="0.01" name="ton_kernel_olah" value="<?= esc($row['ton_kernel_olah']) ?>" class="form-control"></div>

<hr class="my-3">
<h6>Distribusi Power</h6>

<div class="col-md-4">
    <label>KCP</label>
    <input type="number" step="0.01" name="kcp"
           value="<?= $power['kcp'] ?? 0 ?>" class="form-control">
</div>

<div class="col-md-4">
    <label>PKS Gateng</label>
    <input type="number" step="0.01" name="pks_gateng"
           value="<?= $power['pks_gateng'] ?? 0 ?>" class="form-control">
</div>

<div class="col-md-4">
    <label>MCP</label>
    <input type="number" step="0.01" name="mcp"
           value="<?= $power['mcp'] ?? 0 ?>" class="form-control">
</div>

<div class="col-md-4">
    <label>Estate</label>
    <input type="number" step="0.01" name="estate"
           value="<?= $power['estate'] ?? 0 ?>" class="form-control">
</div>

<div class="col-md-4">
    <label>Granul</label>
    <input type="number" step="0.01" name="granul"
           value="<?= $power['granul'] ?? 0 ?>" class="form-control">
</div>


<div class="mt-4 d-flex gap-2">
    <button class="btn btn-primary">Update</button>
    <a href="/produksi" class="btn btn-secondary">Kembali</a>
</div>

</form>
<?= $this->endSection() ?>
