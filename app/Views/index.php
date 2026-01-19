<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<style>
/* ===== DASHBOARD HEADER ===== */
.dashboard-header {
    overflow: hidden;
    border-radius: 10px;
}

/* Panorama */
.panorama-wrapper {
    position: relative;
    height: 160px; /* kecil & elegan */
    overflow: hidden;
    border-radius: 10px 10px 0 0;
}

.panorama-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.8);
}



/* Running Text */
.marquee-container {
    background: #1e1e2f;
    color: #fff;
    padding: 10px 0;
    overflow: hidden;
    border-radius: 0 0 10px 10px;
}

.marquee-text {
    display: inline-block;
    white-space: nowrap;
    font-weight: 600;
    font-size: 15px;
    letter-spacing: 1px;
    padding-left: 100%;
    animation: marquee 15s linear infinite;
}

/* Animation */
@keyframes marquee {
    0%   { transform: translateX(0); }
    100% { transform: translateX(-100%); }
}

/* Mobile */
@media (max-width: 768px) {
    .panorama-wrapper {
        height: 120px;
    }

    .marquee-text {
        font-size: 14px;
    }
}
</style>


<!-- ================= DASHBOARD HEADER ================= -->
<div class="dashboard-header mb-4">

    <!-- Panorama -->
    <div class="panorama-wrapper">
        <img
            src="<?= base_url('assets/img/cover_mcp.jpg') ?>"
            alt="Panorama MCP"
            class="panorama-img"
        >
        <div class="panorama-overlay"></div>
    </div>

    <!-- Running Text -->
    <div class="marquee-container">
        <div class="marquee-text">
            ⚡ SELAMAT DATANG DI SISTEM INFORMASI MCP WSSL 1 ⚡
        </div>
    </div>

</div>


<!-- Alerts -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-warning fw-bold">
        🔔 Alerts & Notifications
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">🌧️ Cuaca sedang musim hujan, jaga kesehatan</li>
            <li class="list-group-item">⚙️ Utamakan keselamatan kerja</li>
        </ul>
    </div>
</div>

<!-- ================= ENGINE SECTION ================= -->
<?php if (!empty($engines)): ?>
<?php foreach ($engines as $engine): ?>

<div class="row g-3 mb-4">
    <h2><?= esc($engine['nama']) ?></h2>

    <!-- Power -->
    <div class="col-md-3">
        <div class="card shadow-sm border-0 text-center">
            <div class="card-body">
                <h6 class="text-muted">Power Listrik</h6>
                <h3 class="fw-bold">
                    <?= $engine['kwh'] ? number_format($engine['kwh']) . ' kWh' : '-' ?>
                </h3>
            </div>
        </div>
    </div>

    <!-- Jam Operasi -->
    <div class="col-md-3">
        <div class="card shadow-sm border-0 text-center">
            <div class="card-body">
                <h6 class="text-muted">Jam Operasional</h6>
                <h3 class="fw-bold">
                    <?= $engine['jam_operasi'] !== null ? $engine['jam_operasi'] . ' Jam' : '-' ?>
                </h3>
            </div>
        </div>
    </div>

    <!-- Ganti Oli -->
    <div class="col-md-3">
        <div class="card shadow-sm border-0 text-center">
            <div class="card-body">
                <h6 class="text-muted">Ganti Oli Selanjutnya</h6>

                <?php if ($engine['oli_calc']): ?>
                    <h3 class="text-<?= $engine['oli_calc']['status'] ?> fw-bold mb-1">
                        <?= $engine['oli_calc']['sisa_jam'] ?> Jam
                    </h3>
                    <div class="text-muted small">
                        <?= $engine['oli_calc']['estimasi_tanggal'] ?>
                    </div>
                <?php else: ?>
                    <span class="text-muted">Belum ada data</span>
                <?php endif ?>
            </div>
        </div>
    </div>


    <!-- Overhaul -->
    <div class="col-md-3">
        <div class="card shadow-sm border-0 text-center">
            <div class="card-body">
                <h6 class="text-muted">Overhaul Selanjutnya</h6>

                <?php if ($engine['overhaul_calc']): ?>
                    <h3 class="text-<?= $engine['overhaul_calc']['status'] ?> fw-bold mb-1">
                        <?= $engine['overhaul_calc']['sisa_jam'] ?> Jam
                    </h3>
                    <div class="text-muted small">
                        <?= $engine['overhaul_calc']['estimasi_tanggal'] ?>
                    </div>
                <?php else: ?>
                    <span class="text-muted">Belum ada data</span>
                <?php endif ?>
            </div>
        </div>
    </div>


</div>

<?php endforeach ?>
<?php endif ?>

<!-- ================= BUDGET & REALISASI ================= -->
<?php
$targets = [
    ['label' => 'Ton TBS Olah',        'value' => $summary['ton_tbs'],      'target' => $budget['ton_tbs'],      'bar' => 'info'],
    ['label' => 'POME',               'value' => $summary['pome'],         'target' => $budget['pome'],         'bar' => 'success'],
    ['label' => 'Umpan Bioreaktor',    'value' => $summary['umpan'],        'target' => $budget['umpan_bioreaktor'], 'bar' => 'success'],
    ['label' => 'Produksi Biogas',     'value' => $summary['biogas'],       'target' => $budget['produksi_biogas'], 'bar' => 'primary'],
    ['label' => 'Produksi Daya Listrik','value'=> $summary['listrik'],      'target' => $budget['produksi_daya_listrik'], 'bar' => 'warning'],
    ['label' => 'Ton Kernel Olah',     'value' => $summary['kernel'],       'target' => $budget['ton_kernel'],   'bar' => 'info'],
    ['label' => 'kWh / Biogas',        'value' => $summary['kwh_biogas'],   'target' => $budget['kwh_per_biogas'], 'bar' => 'success'],
    ['label' => 'Biogas / POME',       'value' => $summary['biogas_pome'],  'target' => $budget['biogas_per_pome'], 'bar' => 'secondary'],
];
?>




<div class="card border-0 shadow-sm">
    <div class="card-header bg-primary text-white fw-bold">
        Realisasi Budget Tahun <?= esc($tahun) ?>
    </div>

    <div class="card-body">
        <p class="text-center text-muted mb-3">
            Update: <strong><?= date('d-M-Y') ?></strong>
        </p>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Item</th>
                        <th>Realisasi</th>
                        <th>Budget</th>
                        <th>Progress</th>
                        <th>%</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach ($targets as $t): ?>
                    <?php
                        $percent = ($t['target'] > 0)
                            ? ($t['value'] / $t['target']) * 100
                            : 0;
                    ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= $t['label'] ?></td>
                        <td><?= number_format($t['value'], 2) ?></td>
                        <td><?= number_format($t['target'], 2) ?></td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar bg-<?= $t['bar'] ?>"
                                     style="width:<?= min($percent, 100) ?>%">
                                    <?= number_format($percent, 2) ?>%
                                </div>
                            </div>
                        </td>
                        <td><?= number_format($percent, 2) ?>%</td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-dark text-white fw-bold">
        🎥 Pengenalan Lingkungan Kerja MCP
    </div>

    <div class="card-body">
        <div class="row g-3">

            <!-- VIDEO 1 -->
            <div class="col-12 col-md-4">
                <div class="ratio ratio-16x9">
                    <iframe
                        src="https://www.youtube.com/embed/-w_djd6Yn5g"
                        title="Bioreaktor MCP"
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="mt-2 text-center fw-semibold">
                    Bioreaktor
                </div>
            </div>

            <!-- VIDEO 2 -->
            <div class="col-12 col-md-4">
                <div class="ratio ratio-16x9">
                    <iframe
                        src="https://www.youtube.com/embed/iBJZv3lBT60"
                        title="Scrubber MCP"
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="mt-2 text-center fw-semibold">
                    Scrubber
                </div>
            </div>

            <!-- VIDEO 3 -->
            <div class="col-12 col-md-4">
                <div class="ratio ratio-16x9">
                    <iframe
                        src="https://www.youtube.com/embed/Ez4A9cSH9Fg"
                        title="Engine Room MCP"
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="mt-2 text-center fw-semibold">
                    Engine Room MCP
                </div>
            </div>

        </div>
    </div>
</div>


<?= $this->endSection() ?>
