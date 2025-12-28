<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">Edit Maintenance Engine</h3>

<!-- Alert error -->
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif ?>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="<?= base_url('maintenance-engine/update/'.$row['id']) ?>" method="post">
            <?= csrf_field() ?>

            <!-- Engine -->
            <div class="mb-3">
                <label class="form-label fw-bold">Engine</label>
                <select name="idbarang" class="form-select" required>
                    <?php foreach ($engine as $e): ?>
                        <option value="<?= $e['id'] ?>"
                            <?= ($e['id'] == $row['idbarang']) ? 'selected' : '' ?>>
                            <?= esc($e['nama_barang']) ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <!-- Jenis Maintenance -->
            <div class="mb-3">
                <label class="form-label fw-bold">Jenis Maintenance</label>
                <select name="jenis_maintenance" id="jenisMaintenance" class="form-select" required>
                    <option value="oli" <?= $row['jenis_maintenance'] == 'oli' ? 'selected' : '' ?>>Ganti Oli</option>
                    <option value="overhaul" <?= $row['jenis_maintenance'] == 'overhaul' ? 'selected' : '' ?>>Overhaul</option>
                    <option value="filter" <?= $row['jenis_maintenance'] == 'filter' ? 'selected' : '' ?>>Filter</option>
                    <option value="sampling oli" <?= $row['jenis_maintenance'] == 'sampling oli' ? 'selected' : '' ?>>Sampling Oli</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>

            <!-- Jenis Maintenance Manual -->
            <div class="mb-3" id="jenisLainBox" style="display:none;">
                <label class="form-label fw-bold">Jenis Maintenance (Manual)</label>
                <input type="text"
                       name="jenis_lain"
                       class="form-control"
                       placeholder="Masukkan jenis maintenance">
            </div>

            <!-- HM Saat Maintenance -->
            <div class="mb-3">
                <label class="form-label fw-bold">HM Saat Maintenance</label>
                <input type="number"
                       step="0.01"
                       name="hm_saat_maintenance"
                       class="form-control"
                       value="<?= esc($row['hm_saat_maintenance']) ?>"
                       required>
            </div>

            <!-- Interval HM -->
            <div class="mb-3">
                <label class="form-label fw-bold">Interval HM</label>
                <input type="number"
                       step="0.01"
                       name="interval_hm"
                       class="form-control"
                       value="<?= esc($row['interval_hm']) ?>"
                       required>
                <small class="text-muted">
                    Contoh: Oli = 2000 jam
                </small>
            </div>

            <!-- Tanggal -->
            <div class="mb-3">
                <label class="form-label fw-bold">Tanggal Maintenance</label>
                <input type="date"
                       name="tanggal"
                       class="form-control"
                       value="<?= esc($row['tanggal']) ?>"
                       required>
            </div>

            <!-- Keterangan -->
            <div class="mb-3">
                <label class="form-label fw-bold">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3"><?= esc($row['keterangan']) ?></textarea>
            </div>

            <!-- Action -->
            <div class="d-flex justify-content-end gap-2">
                <a href="<?= base_url('maintenance-engine') ?>" class="btn btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    Update Maintenance
                </button>
            </div>

        </form>

    </div>
</div>

<!-- Script tampilkan input manual -->
<script>
document.getElementById('jenisMaintenance').addEventListener('change', function () {
    const box = document.getElementById('jenisLainBox');
    box.style.display = (this.value === 'lainnya') ? 'block' : 'none';
});
</script>

<?= $this->endSection() ?>
