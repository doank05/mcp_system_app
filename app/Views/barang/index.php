<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<div class="container-fluid">

    <h4 class="fw-bold text-primary mb-3">📦 Data Barang / Aset</h4>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- SEARCH & ACTION -->
    <form method="get" class="row g-2 mb-3 align-items-center">
        <div class="col-md-4">
            <input type="text"
                   name="q"
                   value="<?= esc($keyword ?? '') ?>"
                   class="form-control"
                   placeholder="Cari kode / nama / lokasi barang...">
        </div>

        <div class="col-md-2">
            <button class="btn btn-outline-primary w-100">
                🔍 Cari
            </button>
        </div>

        <div class="col-md-6 text-md-end text-start">
            <a href="/barang/create" class="btn btn-primary">
                + Tambah Barang
            </a>
        </div>
    </form>

    <!-- TABLE -->
    <div class="card border-0 shadow-sm">
        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Stasiun</th>
                        <th>Lokasi</th>
                        <th>Kondisi</th>
                        <th width="170">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php if (empty($barang)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            Data barang tidak ditemukan
                        </td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($barang as $b): ?>
                    <tr>
                        <td><?= esc($b['kode_barang']) ?></td>
                        <td><?= esc($b['nama_barang']) ?></td>
                        <td><?= esc($b['bagian']) ?></td>
                        <td><?= esc($b['lokasi']) ?></td>
                        <td class="text-center">
                            <?php
                                $badge = match ($b['kondisi']) {
                                    'baik' => 'success',
                                    'perlu_perawatan' => 'warning',
                                    'rusak' => 'danger',
                                    default => 'secondary'
                                };
                            ?>
                            <span class="badge bg-<?= $badge ?>">
                                <?= ucfirst(str_replace('_',' ', $b['kondisi'])) ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="/barang-log/<?= $b['id'] ?>"
                               class="btn btn-info btn-sm">
                               Log
                            </a>
                            <a href="/barang/edit/<?= $b['id'] ?>"
                               class="btn btn-warning btn-sm">
                               Edit
                            </a>
                            <a href="/barang/delete/<?= $b['id'] ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Hapus barang ini?')">
                               Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>

<?= $this->endSection() ?>
