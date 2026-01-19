<?= $this->extend('layout/mainDashboardLogin') ?>
<?= $this->section('content') ?>

<h4 class="mb-4">📊 Dashboard MCP</h4>

<div class="row">

    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-start border-4 border-dark">
            <div class="card-body">
                <div class="text-muted small">TOTAL BARANG DAN MESIN</div>
                <div class="fs-4 fw-semibold">
                    <?= $totalBarang ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-start border-4 border-primary">
            <div class="card-body">
                <div class="text-muted small">PEKERJAAN DI ENGINE</div>
                <div class="fs-4 fw-semibold">
                    <?= $engineCount ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-start border-4 border-success">
            <div class="card-body">
                <div class="text-muted small">PEKERJAAN NON ENGINE</div>
                <div class="fs-4 fw-semibold">
                    <?= $nonEngineCount ?>
                </div>
            </div>
        </div>
    </div>

</div>

<hr>

<?php if ($level === '1'): ?>
    <div class="alert alert-secondary">
        Anda login sebagai <strong>ADMIN</strong>. Semua fitur tersedia.
    </div>
<?php elseif ($level === '2'): ?>
    <div class="alert alert-secondary">
        Anda login sebagai <strong>SUPERVISOR</strong>. Fokus monitoring & pekerjaan.
    </div>
<?php elseif ($level === '3'): ?>
    <div class="alert alert-secondary">
        Anda login sebagai <strong>OPERATOR</strong>. Fokus input & maintenance.
    </div>
<?php else: ?>
    <div class="alert alert-secondary">
        Anda login sebagai <strong>VIEWER</strong>. Akses hanya lihat data.
    </div>
<?php endif; ?>

<?= $this->endSection() ?>
