<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h4 class="mb-4">Edit Data Engine</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="/data-engine/update/<?= $row['id'] ?>" method="post">

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal"
                           value="<?= esc($row['tanggal']) ?>"
                           class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nama Engine</label>
                    <select name="idbarang" class="form-select" required>
                        <option value="">-- Pilih Engine --</option>
                        <?php foreach ($engine as $e): ?>
                            <option value="<?= $e['id'] ?>"
                                <?= $row['idbarang'] == $e['id'] ? 'selected' : '' ?>>
                                <?= esc($e['nama_barang']) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">HM Awal</label>
                    <input type="number" step="0.01" name="hm_awal" id="hm_awal"
                           value="<?= esc($row['hm_awal']) ?>"
                           class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">HM Akhir</label>
                    <input type="number" step="0.01" name="hm_akhir" id="hm_akhir"
                           value="<?= esc($row['hm_akhir']) ?>"
                           class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Jam Operasi</label>
                    <input type="number" step="0.01" name="jam_operasi" id="jam_operasi"
                           value="<?= esc($row['jam_operasi']) ?>"
                           class="form-control" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">kWh</label>
                    <input type="number" step="0.01" name="kwh"
                           value="<?= esc($row['kwh']) ?>"
                           class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3"><?= esc($row['keterangan']) ?></textarea>
                </div>
            </div>

            <div class="text-end">
                <a href="/data-engine" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

        </form>

    </div>
</div>

<script>
    function hitungJamOperasi() {
        let awal = parseFloat(document.getElementById('hm_awal').value) || 0;
        let akhir = parseFloat(document.getElementById('hm_akhir').value) || 0;

        document.getElementById('jam_operasi').value =
            akhir >= awal ? (akhir - awal).toFixed(2) : '';
    }

    document.getElementById('hm_awal').addEventListener('input', hitungJamOperasi);
    document.getElementById('hm_akhir').addEventListener('input', hitungJamOperasi);
</script>

<?= $this->endSection() ?>
