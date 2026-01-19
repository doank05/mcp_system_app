<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">⚙️ Inventory Engine</h4>
</div>

<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Engine</th>
                    <th>Kategori</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($barang)): ?>
                <?php $no = 1; foreach ($barang as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($row['nama_barang'] ?? '-') ?></td>
                    <td><?= esc($row['kategori'] ?? '-') ?></td>
                    <td>
                        <a href="/inventory/engine/detail/<?= $row['id'] ?>"
                           class="btn btn-sm btn-primary">
                            Detail
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        Belum ada data engine
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
