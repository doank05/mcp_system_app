<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="p-4">
    <h1 class="fw-bold text-primary mb-4">🧰 Jadwal Perawatan Mesin dan Kebersihan Area</h1>
    <p class="text-muted">Berikut jadwal perawatan mesin atau pembersihan area 7 hari kedepan.</p>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">
            Jadwal Perawatan Minggu Ini
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th>Tanggal</th>
                            <th>Mesin / Area</th>
                            <th>Pekerjaan</th>
                            <th>Penanggung Jawab</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (empty($pekerjaan)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">Tidak ada data dalam 7 hari kedepan.</td>
                            </tr>

                        <?php else: ?>
                            <?php foreach ($pekerjaan as $p): ?>

                                <tr>
                                    <td>
                                        <?= date('d M Y', strtotime($p['tanggalMulai'])) ?>
                                        -
                                        <?= date('d M Y', strtotime($p['tanggalSelesai'])) ?>
                                    </td>

                                    <td><?= $p['nama_pekerjaan'] ?></td>

                                    <td><?= $p['deskripsi'] ?: '-' ?></td>

                                    <td class="text-center"><?= $p['nama_karyawan'] ?></td>

                                    <td>
                                        <?php if ($p['status'] == 'pending'): ?>
                                            <span class="badge bg-warning text-dark">Belum</span>

                                        <?php elseif ($p['status'] == 'progress'): ?>
                                            <span class="badge bg-info text-dark">Proses</span>

                                        <?php elseif ($p['status'] == 'selesai'): ?>
                                            <span class="badge bg-success">Selesai</span>

                                        <?php else: ?>
                                            <span class="badge bg-secondary">-</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                            <?php endforeach ?>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="alert alert-secondary mt-4" role="alert">
        📅 <strong>Catatan:</strong> Warna status menunjukkan progress pekerjaan: 
        <span class="badge bg-warning text-dark">Belum</span>,
        <span class="badge bg-info text-dark">Proses</span>,
        <span class="badge bg-success">Selesai</span>.
    </div>
</div>

<?= $this->endSection() ?>
