<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">Tambah Maintenance Engine</h3>

<!-- Alert -->
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif ?>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form action="<?= base_url('maintenance-engine/store') ?>" method="post">
            <?= csrf_field() ?>

            <div class="row g-3">

                <!-- Engine -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Engine</label>
                    <select name="idbarang" class="form-select" required>
                        <option value="">-- Pilih Engine --</option>
                        <?php foreach ($engine as $e): ?>
                            <option value="<?= $e['id'] ?>">
                                <?= esc($e['nama_barang']) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <!-- Tanggal -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Tanggal Maintenance</label>
                    <input type="date"
                           name="tanggal"
                           class="form-control"
                           required>
                </div>

                <!-- Jenis Maintenance -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Jenis Maintenance</label>
                    <select name="jenis_maintenance"
                            id="jenisMaintenance"
                            class="form-select"
                            required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="oli">Ganti Oli</option>
                        <option value="overhaul">Overhaul</option>
                        <option value="filter">Filter</option>
                        <option value="sampling oli">Sampling Oli</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>

                <!-- Jenis Manual -->
                <div class="col-md-6" id="jenisLainBox" style="display:none;">
                    <label class="form-label fw-bold">Jenis Maintenance (Manual)</label>
                    <input type="text"
                           name="jenis_lain"
                           class="form-control"
                           placeholder="Masukkan jenis maintenance">
                </div>

                <!-- HM Saat Maintenance -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">HM Saat Maintenance</label>
                    <input type="number"
                           step="0.01"
                           name="hm_saat_maintenance"
                           class="form-control"
                           placeholder="Contoh: 12000"
                           required>
                </div>

                <!-- Interval HM -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Interval HM</label>
                    <input type="number"
                           step="0.01"
                           name="interval_hm"
                           id="intervalHM"
                           class="form-control"
                           value="2000"
                           required>
                    <small class="text-muted">
                        Default oli: 2000 jam
                    </small>
                </div>

                <!-- Keterangan -->
                <div class="col-12">
                    <label class="form-label fw-bold">Keterangan</label>
                    <textarea name="keterangan"
                              class="form-control"
                              rows="3"
                              placeholder="Catatan tambahan (opsional)"></textarea>
                </div>

            </div>

            <!-- Action -->
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="<?= base_url('maintenance-engine') ?>" class="btn btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    Simpan Maintenance
                </button>
            </div>

        </form>

    </div>
</div>

<!-- Script -->
<script>
document.getElementById('jenisMaintenance').addEventListener('change', function () {
    const jenis = this.value;
    const box = document.getElementById('jenisLainBox');
    const interval = document.getElementById('intervalHM');

    if (jenis === 'lainnya') {
        box.style.display = 'block';
        interval.value = '';
    } else {
        box.style.display = 'none';
        if (jenis === 'oli') {
            interval.value = 2000;
        }
    }
});
</script>

<?= $this->endSection() ?>
