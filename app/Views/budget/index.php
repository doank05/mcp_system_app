<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h3 class="mb-3">📊 Budget Tahunan</h3>

<a href="/budget/create" class="btn btn-primary mb-3">+ Tambah Budget</a>

<table class="table table-bordered table-striped">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Tahun</th>
            <th>Ton TBS</th>
            <th>POME</th>
            <th>Biogas</th>
            <th>Daya Listrik</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($data as $d): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $d['tahun'] ?></td>
            <td><?= number_format($d['ton_tbs']) ?></td>
            <td><?= number_format($d['pome']) ?></td>
            <td><?= number_format($d['produksi_biogas']) ?></td>
            <td><?= number_format($d['produksi_daya_listrik']) ?></td>
            <td>
                <a href="/budget/edit/<?= $d['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="/budget/delete/<?= $d['id'] ?>"
                   onclick="return confirm('Hapus budget ini?')"
                   class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?= $this->endSection() ?>
