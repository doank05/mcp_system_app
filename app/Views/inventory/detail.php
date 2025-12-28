<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">🔍 Detail Barang</h3>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="fw-bold"><?= esc($barang['nama_barang']) ?></h5>
        <p class="mb-1"><strong>Kode:</strong> <?= esc($barang['kode_barang']) ?></p>
        <p class="mb-1"><strong>Lokasi:</strong> <?= esc($barang['lokasi']) ?></p>
        <p class="mb-1"><strong>Bagian:</strong> <?= esc($barang['bagian']) ?></p>
        <p><strong>Kondisi:</strong> <?= esc($barang['kondisi']) ?></p>
    </div>
</div>

<h5 class="mb-3">🛠 Riwayat Perawatan</h5>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered align-middle">
            <thead class="table-light text-center">
                <tr>
                    <th>Tanggal</th>
                    <th>Pekerjaan</th>
                    <th>Deskripsi</th>
                    <th>Petugas</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($history): foreach ($history as $h): ?>
                <tr>
                    <td><?= esc($h['tanggalMulai']) ?> - <?= esc($h['tanggalSelesai']) ?></td>
                    <td><?= esc($h['nama_pekerjaan']) ?></td>
                    <td><?= esc($h['deskripsi']) ?></td>
                    <td><?= esc($h['nama_karyawan']) ?></td>
                    <td class="text-center">
                        <span class="badge bg-<?= 
                            $h['status']=='selesai' ? 'success' :
                            ($h['status']=='progress' ? 'info' : 'warning')
                        ?>">
                            <?= esc($h['status']) ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        Belum ada riwayat perawatan
                    </td>
                </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<a href="/inventory" class="btn btn-secondary mt-3">← Kembali</a>

<?= $this->endSection() ?>
