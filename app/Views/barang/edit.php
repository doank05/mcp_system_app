<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h3 class="mb-4">Edit Barang</h3>

<div class="card shadow-sm">
<div class="card-body">

<form action="/barang/update/<?= $barang['id'] ?>" method="post">

    <div class="mb-3">
        <label>Kode Barang</label>
        <input type="text" name="kode_barang" class="form-control"
               value="<?= esc($barang['kode_barang']) ?>">
    </div>

    <div class="mb-3">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" class="form-control"
               value="<?= esc($barang['nama_barang']) ?>" required>
    </div>

    <div class="mb-3">
        <label>Kategori</label>
        <select name="kategori" class="form-select">
            <?php foreach (['mesin','pompa','panel','sensor','lainnya'] as $k): ?>
                <option value="<?= $k ?>" <?= $barang['kategori']==$k?'selected':'' ?>>
                    <?= ucfirst($k) ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Lokasi</label>
        <input type="text" name="lokasi" class="form-control"
               value="<?= esc($barang['lokasi']) ?>">
    </div>

    <div class="mb-3">
        <label>Bagian</label>
        <select name="bagian" class="form-select">
            <?php foreach (['engine_room','scrubber','bioreaktor'] as $b): ?>
                <option value="<?= $b ?>" <?= $barang['bagian']==$b?'selected':'' ?>>
                    <?= ucwords(str_replace('_',' ',$b)) ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Tanggal Pasang</label>
        <input type="date" name="tanggal_pasang" class="form-control"
               value="<?= $barang['tanggal_pasang'] ?>">
    </div>

    <div class="mb-3">
        <label>Kondisi</label>
        <select name="kondisi" class="form-select">
            <?php foreach (['baik','perlu_perawatan','rusak'] as $k): ?>
                <option value="<?= $k ?>" <?= $barang['kondisi']==$k?'selected':'' ?>>
                    <?= ucwords(str_replace('_',' ',$k)) ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="/barang" class="btn btn-secondary">Kembali</a>

</form>

</div>
</div>

<?= $this->endSection() ?>
