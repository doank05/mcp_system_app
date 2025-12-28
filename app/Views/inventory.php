<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="p-4">

    <h1 class="fw-bold text-primary mb-3">📦 Inventory Barang</h1>
    <p class="text-muted mb-4">
        Daftar barang beserta riwayat perawatan dan pekerjaan.
    </p>

    <!-- SEARCH -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="/inventory">
                <div class="row g-2 align-items-center">
                    <div class="col-md-6">
                        <input type="text"
                               name="keyword"
                               class="form-control"
                               placeholder="🔍 Cari nama barang / kode barang..."
                               value="<?= esc($_GET['keyword'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">
                            Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- TABLE BARANG -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">
            Daftar Barang
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Bagian</th>
                        <th>Kondisi</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php if (empty($barang)): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Data barang tidak ditemukan
                        </td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($barang as $b): ?>
                    <tr>
                        <td class="text-center"><?= esc($b['kode_barang']) ?></td>
                        <td><?= esc($b['nama_barang']) ?></td>
                        <td class="text-center"><?= esc($b['kategori']) ?></td>
                        <td><?= esc($b['lokasi']) ?></td>
                        <td class="text-center"><?= esc($b['bagian']) ?></td>

                        <td class="text-center">
                            <?php
                            $badge = [
                                'baik' => 'bg-success',
                                'perlu_perawatan' => 'bg-warning text-dark',
                                'rusak' => 'bg-danger'
                            ];
                            ?>
                            <span class="badge <?= $badge[$b['kondisi']] ?>">
                                <?= ucfirst(str_replace('_',' ',$b['kondisi'])) ?>
                            </span>
                        </td>

                        <td class="text-center">
                            <a href="/inventory/<?= $b['id'] ?>"
                               class="btn btn-sm btn-outline-primary">
                                Detail
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
