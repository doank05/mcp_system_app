<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">Edit Karyawan</h3>

<div class="card shadow-sm">
<div class="card-body">

<form action="/karyawan/update/<?= $karyawan['id'] ?>" method="POST">

<div class="mb-3">
    <label>NIK</label>
    <input type="text" name="nik" value="<?= esc($karyawan['nik']) ?>" class="form-control">
</div>

<div class="mb-3">
    <label>Nama</label>
    <input type="text" name="nama" value="<?= esc($karyawan['nama']) ?>" class="form-control">
</div>

<div class="mb-3">
    <label>Jabatan</label>
    <select name="jabatan" class="form-select">
        <?php foreach(['asisten','mandor','anggota'] as $j): ?>
        <option value="<?= $j ?>" <?= $karyawan['jabatan']==$j?'selected':'' ?>>
            <?= ucfirst($j) ?>
        </option>
        <?php endforeach ?>
    </select>
</div>

<div class="mb-3">
    <label>TMK</label>
    <input type="date" name="tmk" value="<?= esc($karyawan['tmk']) ?>" class="form-control">
</div>

<div class="mb-3">
    <label>Password (kosongkan jika tidak diubah)</label>
    <input type="password" name="password" class="form-control">
</div>

<button class="btn btn-primary">Update</button>
<a href="/karyawan" class="btn btn-secondary">Kembali</a>

</form>

</div>
</div>

<?= $this->endSection() ?>
