<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h4 class="mb-3">Preview Import Data Engine</h4>

<form action="<?= base_url('data-engine/importExcel') ?>" method="post">
    <?= csrf_field() ?>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Tanggal</th>
                    <th>HM Awal</th>
                    <th>HM Akhir</th>
                    <th>Jam Operasi</th>
                    <th>kWh</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $i => $r): ?>
                    <?php if ($i === 1) continue; ?>
                    <tr>
                        <td><?= esc($r['A']) ?></td>
                        <td><?= esc($r['B']) ?></td>
                        <td><?= esc($r['C']) ?></td>
                        <td><?= esc($r['C'] - $r['B']) ?></td>
                        <td><?= esc($r['D']) ?></td>
                        <td><?= esc($r['E']) ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <div class="mt-3 text-end">
        <a href="<?= base_url('data-engine') ?>" class="btn btn-secondary">
            Batal
        </a>
        <button type="submit" class="btn btn-success">
            Konfirmasi Import
        </button>
    </div>
</form>

<?= $this->endSection() ?>
