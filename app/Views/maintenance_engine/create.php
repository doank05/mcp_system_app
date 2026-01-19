<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h4 class="mb-4">Tambah Maintenance Engine</h4>

<form action="<?= base_url('/maintenance-engine/store') ?>" method="post">
    <?= csrf_field() ?>

    <!-- KARYAWAN -->
    <div class="mb-3">
        <label class="form-label">Karyawan Bertugas</label>
        <select name="user_id" class="form-select" required>
            <option value="">-- Pilih Karyawan --</option>
            <?php foreach ($karyawan as $k): ?>
                <option value="<?= $k['id'] ?>">
                    <?= esc($k['nama']) ?> (<?= esc($k['nik']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>


    <!-- ENGINE -->
    <div class="mb-3">
        <label class="form-label">Engine</label>
        <select name="idbarang" class="form-select" required>
            <option value="">-- Pilih Engine --</option>
            <?php foreach ($engine as $e): ?>
                <option value="<?= $e['id'] ?>">
                    <?= esc($e['nama_barang']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- JENIS -->
    <div class="mb-3">
        <label class="form-label">Jenis Maintenance</label>
        <select name="jenis_maintenance" id="jenisMaintenance" class="form-select" required>
            <option value="">-- Pilih --</option>
            <option value="oli">Ganti Oli</option>
            <option value="overhaul">Overhaul</option>
            <option value="lainnya">Lainnya</option>
        </select>
    </div>

    <div class="mb-3 d-none" id="jenisLainnya">
        <label class="form-label">Jenis Lainnya</label>
        <input type="text" name="jenis_lain" class="form-control">
    </div>

    <!-- HM -->
    <div class="mb-3">
        <label class="form-label">HM Saat Maintenance</label>
        <input type="number" name="hm_saat_maintenance" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Interval HM</label>
        <input type="number" name="interval_hm" class="form-control">
        <small class="text-muted">Otomatis 2000 jika ganti oli</small>
    </div>

    <!-- TANGGAL -->
    <div class="mb-3">
        <label class="form-label">Tanggal</label>
        <input type="date" name="tanggal" class="form-control" required>
    </div>

    <!-- KETERANGAN -->
    <div class="mb-3">
        <label class="form-label">Keterangan</label>
        <textarea name="keterangan" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">
        Simpan
    </button>
    <a href="<?= base_url('/maintenance-engine') ?>" class="btn btn-secondary">
        Batal
    </a>
</form>

<script>
document.getElementById('jenisMaintenance').addEventListener('change', function () {
    document.getElementById('jenisLainnya')
        .classList.toggle('d-none', this.value !== 'lainnya');
});
</script>

<?= $this->endSection() ?>
