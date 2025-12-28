<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">Tambah Karyawan</h3>

<div class="card shadow-sm">
<div class="card-body">

<form action="/karyawan/store" method="POST">

<div class="mb-3">
    <label>NIK</label>
    <input type="text" name="nik" class="form-control" required>
</div>

<div class="mb-3">
    <label>Nama</label>
    <input type="text" name="nama" class="form-control" required>
</div>

<div class="mb-3">
    <label>Jabatan</label>
    <select name="jabatan" class="form-select" required>
        <option value="asisten">Asisten</option>
        <option value="mandor">Mandor</option>
        <option value="anggota">Anggota</option>
    </select>
</div>

<div class="mb-3">
    <label>TMK</label>
    <input type="date" name="tmk" class="form-control" required>
</div>

<div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
</div>

<button class="btn btn-primary">Simpan</button>
<a href="/karyawan" class="btn btn-secondary">Kembali</a>

</form>

</div>
</div>

<?= $this->endSection() ?>
