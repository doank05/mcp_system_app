      <?= $this->extend('layout/main') ?>

      <?= $this->section('content') ?>
      <!-- Content -->
      <div class="col-lg-10 p-4">
        <h1 class="fw-bold text-primary mb-4">Tentang MCP</h1>

        <!-- Intro Card -->
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">
            <h5 class="fw-bold text-secondary">Tentang Website Ini</h5>
            <p class="text-secondary mb-0">
              Website ini merupakan <strong>frontend</strong> dari sistem pemantauan dan pengelolaan <strong>Methane Capture Plant (MCP)</strong>.  
              Proyek ini sedang dalam tahap pengembangan dan adanya rencana pembangunan backend.  
              Tujuan utama dari website ini adalah menyediakan tampilan awal dashboard, informasi proses, dan dokumentasi MCP secara interaktif dan mudah dipahami.
            </p>
          </div>
        </div>

        <!-- Card 4: Status Pengembangan -->
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h5 class="fw-bold text-secondary">Status Pengembangan</h5>
            <p class="text-secondary">
              Website ini masih dalam tahap pengembangan.  
              Berikut rencana pengembangan selanjutnya:
            </p>
            <ul class="text-secondary">
              <li>🔹 Integrasi database (backend CRUD).</li>
              <li>🔹 Fitur analisis efisiensi energi & emisi karbon.</li>
              <li>🔹 Modul laporan otomatis berbasis periode.</li>
            </ul>
            <p class="text-secondary mb-0">Versi saat ini: <strong>v1.0 (Frontend Only)</strong></p>
          </div>
        </div>

      </div>

<?= $this->endSection() ?>