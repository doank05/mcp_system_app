<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h3>Tambah Alert</h3>

<form action="/alert/store" method="post" class="card card-body shadow-sm">
<?= csrf_field() ?>

<div class="mb-3">
  <label class="form-label">Judul</label>
  <input type="text" name="judul" class="form-control" required>
</div>

<div class="mb-3">
  <label class="form-label">Pesan</label>
  <textarea name="pesan" class="form-control" rows="3" required></textarea>
</div>

<div class="mb-3">
  <label class="form-label">Tipe Alert</label>
  <select name="tipe" class="form-select">
    <option value="info">Info</option>
    <option value="warning">Warning</option>
    <option value="danger">Danger</option>
    <option value="success">Success</option>
  </select>
</div>

<div class="form-check mb-3">
  <input type="checkbox" name="is_active" class="form-check-input" checked>
  <label class="form-check-label">Aktifkan Alert</label>
</div>

<button class="btn btn-primary">Simpan</button>
<a href="/alert" class="btn btn-secondary">Kembali</a>

</form>

<?= $this->endSection() ?>
