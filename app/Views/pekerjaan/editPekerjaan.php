<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">Edit Pekerjaan</h3>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="/pekerjaan/update/<?= $pekerjaan['id'] ?>" method="POST">

            <!-- Nama -->
            <div class="mb-3">
                <label class="form-label">Nama Pekerjaan</label>
                <input type="text" name="nama_pekerjaan"
                       value="<?= esc($pekerjaan['nama_pekerjaan']) ?>"
                       class="form-control" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control"><?= esc($pekerjaan['deskripsi']) ?></textarea>
            </div>

            <!-- Tanggal -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tanggalMulai"
                           value="<?= esc($pekerjaan['tanggalMulai']) ?>"
                           class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Tanggal Selesai</label>
                    <input type="date" name="tanggalSelesai"
                           value="<?= esc($pekerjaan['tanggalSelesai']) ?>"
                           class="form-control" required>
                </div>
            </div>

            <!-- BAGIAN -->
            <div class="mb-3">
                <label>Bagian</label>
                <select name="bagian" class="form-select">
                    <?php foreach (['engine_room','scrubber','bioreaktor'] as $b): ?>
                        <option value="<?= $b ?>" <?= $pekerjaan['bagian']==$b?'selected':'' ?>>
                            <?= ucfirst(str_replace('_',' ',$b)) ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <!-- BARANG (INI YANG KURANG SEBELUMNYA) -->
            <div class="mb-3">
                <label class="form-label">Barang</label>
                <select name="barang_id" class="form-select" required>
                    <option value="">-- Pilih Barang --</option>
                    <?php foreach ($barang as $b): ?>
                        <option value="<?= $b['id'] ?>"
                            <?= ($selectedBarang == $b['id']) ? 'selected' : '' ?>>
                            <?= esc($b['nama_barang']) ?> (<?= esc($b['kode_barang']) ?>)
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <!-- NIK -->
            <div class="mb-3">
                <label>NIK Karyawan</label>
                <input type="text" name="nikKaryawan"
                       value="<?= esc($pekerjaan['nikKaryawan']) ?>"
                       class="form-control" required>
            </div>

            <!-- STATUS -->
            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-select">
                    <?php foreach (['pending','progress','selesai'] as $s): ?>
                        <option value="<?= $s ?>" <?= $pekerjaan['status']==$s?'selected':'' ?>>
                            <?= ucfirst($s) ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="/pekerjaan" class="btn btn-secondary">Kembali</a>

        </form>

    </div>
</div>

<?= $this->endSection() ?>
