<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h4 class="mb-4">Tambah Pekerjaan</h4>

<form action="<?= base_url('/pekerjaan/store') ?>" method="post">
    <?= csrf_field() ?>

    <div class="mb-3">
        <label class="form-label">Tipe Pekerjaan</label>
        <select name="tipe_pekerjaan" class="form-select" required>
            <option value="">-- Pilih --</option>
            <option value="engine">Engine</option>
            <option value="non_engine">Non Engine</option>
        </select>
    </div>

    <div class="mb-3">
    <label class="form-label">Karyawan Bertugas</label>
    <select name="nik" class="form-select" required>
        <option value="">-- Pilih Karyawan --</option>
        <?php foreach ($karyawan as $k): ?>
            <option value="<?= esc($k['nik']) ?>">
                <?= esc($k['nik']) ?> - <?= esc($k['nama']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    </div>
            

    <button type="submit" class="btn btn-primary">
        Lanjutkan
    </button>
    <a href="<?= base_url('/pekerjaan') ?>" class="btn btn-secondary">
        Batal
    </a>
</form>

<?= $this->endSection() ?>
