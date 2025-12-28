<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">📦 Inventory Barang</h3>

<form method="get" class="mb-3">
    <div class="input-group">
        <input type="text" name="keyword" class="form-control"
               placeholder="Cari nama / kode barang">
        <button class="btn btn-primary">Cari</button>
    </div>
</form>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Kondisi</th>
                    <th width="120">Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barang as $b): ?>
                <tr>
                    <td><?= esc($b['kode_barang']) ?></td>
                    <td><?= esc($b['nama_barang']) ?></td>
                    <td><?= esc($b['kategori']) ?></td>
                    <td><?= esc($b['lokasi']) ?></td>
                    <td class="text-center">
                        <span class="badge bg-<?= 
                            $b['kondisi']=='baik' ? 'success' :
                            ($b['kondisi']=='perlu_perawatan' ? 'warning' : 'danger')
                        ?>">
                            <?= esc($b['kondisi']) ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <a href="/inventory/<?= $b['id'] ?>" class="btn btn-sm btn-info">
                            Detail
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
