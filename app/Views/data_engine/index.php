<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h4 class="mb-3">Data Engine</h4>

    <?php if (canCreate('data-engine')): ?>
    <a href="/data-engine/create" class="btn btn-primary mb-3">+ Tambah Data</a>
    <?php endif ?>
    <form action="<?= base_url('data-engine/previewExcel') ?>"
      method="post"
      enctype="multipart/form-data"
      class="card card-body mb-4">

    <?= csrf_field() ?>


    <div class="row g-3 align-items-end">
    <?php if (canCreate('data-engine')): ?>
        <div class="col-md-4">
            <label class="form-label">Pilih Engine</label>
            <select name="idbarang" class="form-select" required>
                <option value="">-- Pilih Engine --</option>
                <?php if (!empty($engine)): ?>
                <?php foreach ($engine as $e): ?>
                    <option value="<?= $e['id'] ?>">
                        <?= esc($e['nama_barang']) ?>
                    </option>
                <?php endforeach ?>
                <?php endif ?>
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label">Upload File (CSV / Excel)</label>
            <input type="file" name="file_excel"
                   class="form-control"
                   accept=".csv,.xls,.xlsx" required>
        </div>

        <div class="col-md-4">
            <button type="submit" class="btn btn-success w-100">
                Import Data Engine
            </button>
        </div>
    <?php endif ?>
    </div>

    
    <small class="text-muted d-block mt-2">
        Format file: tanggal | hm_awal | hm_akhir | kwh | keterangan
    </small>
    </form>


<table class="table table-bordered table-striped align-middle">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Engine</th>
            <th>HM Awal</th>
            <th>HM Akhir</th>
            <th>Jam Operasi</th>
            <th>kWh</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>

    <?php if (!empty($data_engine)): ?>
        <?php
            $no = 1 + (25 * ($pager->getCurrentPage() - 1));
        ?>
        <?php foreach ($data_engine as $row): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
            <td><?= esc($row['nama_barang']) ?></td>
            <td><?= $row['hm_awal'] ?></td>
            <td><?= $row['hm_akhir'] ?></td>
            <td><?= $row['jam_operasi'] ?></td>
            <td><?= $row['kwh'] ?></td>
            <td><?= esc($row['keterangan']) ?></td>
            <td>
                
                <?php if (canEdit('data-engine')): ?>
                <a href="/data-engine/edit/<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <?php endif ?>
                
                <?php if (canDelete('data-engine')): ?>
                <a href="/data-engine/delete/<?= $row['id'] ?>"
                   onclick="return confirm('Yakin hapus data ini?')"
                   class="btn btn-sm btn-danger">
                    Hapus
                </a>
                <?php endif ?>
            </td>
        </tr>
        <?php endforeach ?>
    <?php else: ?>
        <tr>
            <td colspan="9" class="text-center text-muted">
                Belum ada data engine
            </td>
        </tr>
    <?php endif ?>

    </tbody>
</table>

<div class="mt-3 d-flex justify-content-center">
    <?= $pager->links('default', 'bootstrap') ?>
</div>

<?= $this->endSection() ?>
