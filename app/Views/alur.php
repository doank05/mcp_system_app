<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

     <div class="container-fluid">
    <h1 class="fw-bold text-primary mb-4">Alur Proses MCP</h1>
    <p class="text-secondary mb-5">Berikut adalah tahapan utama proses pengolahan biogas pada sistem <strong>Methane Capture Plant (MCP)</strong> — dari input limbah cair hingga pemanfaatan gas metana.</p>

    <!-- Timeline -->
    <div class="timeline">

        <!-- Step 1 -->
        <div class="timeline-step left">
            <div class="circle"></div>
            <div class="card p-4">
                <h5 class="fw-bold text-primary">1️⃣ Kolam Pendingin (Cooling Pond)</h5>
                <p class="text-secondary mb-0">
                    Limbah cair dari pabrik kelapa sawit (POME) dialirkan ke kolam pendingin untuk menurunkan suhu awal sebelum masuk ke sistem reaktor biogas.
                </p>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="timeline-step right">
            <div class="circle"></div>
            <div class="card p-4">
                <h5 class="fw-bold text-primary">2️⃣ Kolam Reaktor (Anaerobic Pond)</h5>
                <p class="text-secondary mb-0">
                    Proses utama berlangsung di kolam anaerob, di mana mikroorganisme menguraikan bahan organik tanpa oksigen dan menghasilkan gas metana (CH₄).
                </p>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="timeline-step left">
            <div class="circle"></div>
            <div class="card p-4">
                <h5 class="fw-bold text-primary">3️⃣ Gas Holder (Penampungan Gas)</h5>
                <p class="text-secondary mb-0">
                    Gas metana yang dihasilkan dikumpulkan di gas holder sebelum disalurkan ke sistem pembersihan (scrubber).
                </p>
            </div>
        </div>

        <!-- Step 4 -->
        <div class="timeline-step right">
            <div class="circle"></div>
            <div class="card p-4">
                <h5 class="fw-bold text-primary">4️⃣ Scrubber Unit (Penyaring Gas)</h5>
                <p class="text-secondary mb-0">
                    Gas dibersihkan dari H₂S dan uap air untuk meningkatkan kualitas gas metana.
                </p>
            </div>
        </div>

        <!-- Step 5 -->
        <div class="timeline-step left">
            <div class="circle"></div>
            <div class="card p-4">
                <h5 class="fw-bold text-primary">5️⃣ Gas Engine (Pembangkit Listrik)</h5>
                <p class="text-secondary mb-0">
                    Gas metana yang sudah bersih digunakan sebagai bahan bakar untuk mesin gas engine dalam menghasilkan energi listrik.
                </p>
            </div>
        </div>

        <!-- Step 6 -->
        <div class="timeline-step right">
            <div class="circle"></div>
            <div class="card p-4">
                <h5 class="fw-bold text-primary">6️⃣ Flare (Pembakaran Gas Sisa)</h5>
                <p class="text-secondary mb-0">
                    Gas berlebih dibakar aman pada flare untuk mengurangi emisi.
                </p>
            </div>
        </div>

    </div>

    <!-- Summary Card -->
    <div class="card border-0 shadow-sm mt-5">
        <div class="card-body">
            <h5 class="fw-bold text-secondary">Kesimpulan</h5>
            <p class="text-secondary mb-0">
                Proses MCP memastikan limbah cair pabrik kelapa sawit diolah secara ramah lingkungan dengan memanfaatkan gas metana menjadi energi listrik.
                Sistem ini berperan penting dalam mengurangi emisi dan mendukung program energi hijau perusahaan.
            </p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
