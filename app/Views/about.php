<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="col-lg-10 p-4">
    <h1 class="fw-bold text-primary mb-4">Tentang MCP</h1>

    <!-- Intro Card -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold text-secondary">Tentang Sistem MCP</h5>
            <p class="text-secondary mb-0">
                Website ini merupakan <strong>sistem informasi dan monitoring Methane Capture Plant (MCP)</strong> 
                yang dikembangkan untuk mendukung kegiatan <strong>operasional, produksi, dan maintenance</strong> 
                secara terintegrasi.
                <br><br>
                Sistem ini dirancang untuk membantu operator dan manajemen dalam 
                <strong>mencatat data harian, memantau performa engine, mengelola jadwal maintenance, 
                serta mengevaluasi pencapaian produksi dan target tahunan</strong> secara real-time dan terstruktur.
            </p>
        </div>
    </div>

    <!-- Fitur Utama -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold text-secondary">Fitur Utama Sistem</h5>
            <ul class="text-secondary mb-0">
                <li>⚙️ Dashboard monitoring engine (HM, jam operasi, kWh).</li>
                <li>🛠️ Manajemen maintenance engine (oli, overhaul, filter, dll).</li>
                <li>📊 Pencatatan dan rekap data produksi harian.</li>
                <li>📈 Monitoring realisasi vs target (budget) tahunan.</li>
                <li>📅 Pengelolaan tahun aktif operasional.</li>
                <li>📥 Import data produksi dan engine melalui Excel.</li>
                <li>🔔 Sistem alert dan notifikasi operasional.</li>
                <li>👥 Pencatatan user (created by & updated by).</li>
            </ul>
        </div>
    </div>

    <!-- Status Pengembangan -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold text-secondary">Status Pengembangan</h5>
            <p class="text-secondary">
                Sistem MCP saat ini telah memasuki tahap <strong>implementasi awal (operasional)</strong>, 
                dengan backend dan database yang sudah berjalan serta fitur utama yang dapat digunakan oleh operator.
            </p>
            <p class="text-secondary mb-2">Beberapa pengembangan lanjutan yang direncanakan:</p>
            <ul class="text-secondary">
                <li>🔹 Grafik performa engine dan produksi berbasis waktu.</li>
                <li>🔹 Alert otomatis berbasis jam operasi dan maintenance.</li>
                <li>🔹 Integrasi data sensor (flow meter, pressure, IoT).</li>
            </ul>
        </div>
    </div>

    <!-- Versi Sistem -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="fw-bold text-secondary">Informasi Versi</h5>
            <p class="text-secondary mb-1">
                Versi Sistem: <strong>v1.0 (Operational Release)</strong>
            </p>
            <p class="text-secondary mb-0">
                Status: <strong>Aktif digunakan & terus dikembangkan</strong>
            </p>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
