<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h4 class="mb-3">Data Engine</h4>

<a href="/data-engine/create" class="btn btn-primary mb-3">+ Tambah Data</a>
    <form action="<?= base_url('data-engine/previewExcel') ?>"
      method="post"
      enctype="multipart/form-data"
      class="card card-body mb-4">

    <?= csrf_field() ?>


    <div class="row g-3 align-items-end">

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

    </div>

    
    <small class="text-muted d-block mt-2">
        Format file: tanggal | hm_awal | hm_akhir | kwh | keterangan
    </small>
    </form>


<table class="table table-bordered table-striped">
        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
<?php endif ?>

    <thead class="table-dark">
        <tr>
            <th>Tanggal</th>
            <th>Engine</th>
            <th>HM Awal</th>
            <th>HM Akhir</th>
            <th>Jam Operasi</th>
            <th>kWh</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data_engine as $row): ?>
        <tr>
            <td><?= $row['tanggal'] ?></td>
            <td><?= $row['nama_barang'] ?></td>
            <td><?= $row['hm_awal'] ?></td>
            <td><?= $row['hm_akhir'] ?></td>
            <td><?= $row['jam_operasi'] ?></td>
            <td><?= $row['kwh'] ?></td>
            <td>
                <a href="/data-engine/edit/<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="/data-engine/delete/<?= $row['id'] ?>" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Hapus data ini?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>    

<?= $this->endSection() ?>
