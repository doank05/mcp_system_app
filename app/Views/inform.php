<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="p-4">

    <h1 class="fw-bold text-primary mb-4">Informasi MCP</h1>

    <!-- =======================
         SECTION: BIOREAKTOR
    ======================== -->
    <section class="mb-5">
        <h3 class="fw-bold text-primary mb-3">1. Bioreaktor <small class="text-muted"></small></h3>
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-dark text-white fw-bold">
            🎥 Bioreaktor
        </div>

        <div class="card-body">
            <div class="ratio ratio-16x9">
                <iframe
                    src="https://www.youtube.com/embed/iBJZv3lBT60"
                    title="Bioreaktor MCP"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body text-secondary">

                <h5 class="fw-bold">• Pit POME</h5>
                <p>
                    Pit ini berfungsi untuk memisahkan pasir dari POME yang dipompa dari kolam 1 sebelum dikirim ke mixing pit
                    lagoon 1 dan 2. Terdiri dari 2 kotak, overflow kotak pertama menuju kotak kedua lalu dipompakan ke mixing pit.
                    POME melewati strainer sebelum masuk mixing pit untuk memaksimalkan pemisahan kotoran.
                </p>

                <h5 class="fw-bold">• Pit Pompa POME</h5>
                <p>
                    Pit untuk memompakan POME dari kotak kedua pit POME ke mixing pit lagoon 1 dan 2.
                </p>

                <h5 class="fw-bold">• Mixing Pit Lagoon 1</h5>
                <p>
                    Di sini POME dicampur dengan sludge aktif (dari kolam 10, bottom sludge lagoon 1, dan sludge recycle sedimen 1)
                    untuk mendapatkan umpan ideal ke biodigester dengan pH 6.5–7.0 dan suhu 35–37°C.
                </p>

                <h5 class="fw-bold">• Mixing Pit Lagoon 2</h5>
                <p>
                    Sama seperti lagoon 1, pencampuran POME dan sludge aktif dilakukan untuk memastikan kualitas umpan ke biodigester.
                </p>

                <h5 class="fw-bold">• Pit Sirkulasi Lagoon 1</h5>
                <p>
                    Tempat pompa feeding dan sirkulasi. Campuran sludge dimasukkan dari nozzle dasar lagoon sambil dilakukan agitasi
                    untuk distribusi substrat dan penyamaan suhu.
                </p>

                <h5 class="fw-bold">• Pit Sirkulasi Lagoon 2</h5>
                <p>
                    Fungsinya sama seperti lagoon 1 untuk feeding dan sirkulasi serta agitasi.
                </p>

                <h5 class="fw-bold">• Pit Transfer Lagoon 1</h5>
                <p>
                    Fasilitas pengurasan sludge jenuh secara periodik agar volume aktif biodigester terjaga dan bakteri tetap optimal.
                </p>

                <h5 class="fw-bold">• Pit Transfer Lagoon 2</h5>
                <p>
                    Fungsi sama seperti lagoon 1, menjaga volume aktif biodigester dengan pengurasan berkala.
                </p>

                <h5 class="fw-bold">• Pit J Lagoon 1</h5>
                <p>
                    Berfungsi memisahkan kandungan air secara gravitasi pada pipa gas sedimen 1 sebelum dialirkan ke jalur pipa gas lagoon 1.
                </p>

                <h5 class="fw-bold">• Pit J Lagoon 2</h5>
                <p>
                    Fungsinya sama seperti lagoon 1 namun untuk jalur gas sedimen 2.
                </p>

                <h5 class="fw-bold">• Rumah Pompa Kolam 10</h5>
                <p>
                    Memiliki 2 pompa untuk suplai sludge dari kolam 10 ke mixing pit lagoon 1 dan 2. Pompa bisa dipakai bergantian.
                </p>

                <h5 class="fw-bold">• Pit Sludge Recycle Sedimen 1</h5>
                <p>
                    Untuk memompakan sludge dari dasar kolam sedimen 1 kembali ke mixing pit lagoon 1.
                </p>

                <h5 class="fw-bold">• Pit Sludge Recycle Sedimen 2</h5>
                <p>
                    Untuk memompakan sludge dari dasar kolam sedimen 2 kembali ke mixing pit lagoon 2.
                </p>

            </div>
        </div>
    </section>

    <!-- =======================
         SECTION: SCRUBBER & FLARE
    ======================== -->
    <section class="mb-5">
        <h3 class="fw-bold text-primary mb-3">2. Scrubber & Flare <small class="text-muted"></small></h3>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-dark text-white fw-bold">
            🎥 Scrubber
        </div>

        <div class="card-body">
            <div class="ratio ratio-16x9">
                <iframe
                    src="https://www.youtube.com/embed/iBJZv3lBT60"
                    title="Scrubber MCP"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body text-secondary">

                <h5 class="fw-bold">• Precooler 1 & 2</h5>
                <p>
                    Menurunkan suhu biogas menggunakan spray air untuk meningkatkan kelarutan H₂S dalam air.
                </p>

                <h5 class="fw-bold">• Scrubber 1, 2, 3</h5>
                <p>
                    Menghilangkan H₂S dari biogas melalui spray air. H₂S perlu direduksi karena sangat korosif.
                </p>

                <h5 class="fw-bold">• Reservoir</h5>
                <p>
                    Tangki penyimpanan air scrubber. pH air harus ≥ 7.0 agar efisien menyerap H₂S.
                </p>

                <h5 class="fw-bold">• Separator 1 & 2</h5>
                <p>
                    Memisahkan kandungan air pada biogas setelah scrubber menggunakan prinsip gravitasi.
                </p>

                <h5 class="fw-bold">• Knock Out Potts 1 & 2</h5>
                <p>
                    Unit lanjutan pemisahan air dalam gas, juga berbasis gravitasi.
                </p>

                <h5 class="fw-bold">• Chiller 1 & 2</h5>
                <p>
                    Mengubah uap air menjadi tetesan air menggunakan sistem refrigerasi.
                </p>

                <h5 class="fw-bold">• Pit Overflow Reservoir</h5>
                <p>
                    Bak untuk menampung overflow reservoir, menjaga agar air tidak jenuh H₂S.
                </p>

                <h5 class="fw-bold">• Flare</h5>
                <p>
                    Membakar kelebihan biogas tanpa melalui scrubber. Sebagai safety jika tekanan gas berlebih.
                </p>

            </div>
        </div>
    </section>

    <!-- =======================
         SECTION: ENGINE ROOM
    ======================== -->
    <section class="mb-4">
        <h3 class="fw-bold text-primary mb-3">3. Engine Room <small class="text-muted"></small></h3>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-dark text-white fw-bold">
            🎥 Engine Room MCP
        </div>

        <div class="card-body">
            <div class="ratio ratio-16x9">
                <iframe
                    src="https://www.youtube.com/embed/JOV5EX6Rjhk"
                    title="Engine Room MCP"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body text-secondary">

                <h5 class="fw-bold">• Jinan 1 & 3</h5>
                <p>
                    Genset generasi awal yang digunakan sebagai pembangkit listrik di MCP.
                </p>

                <h5 class="fw-bold">• Jenbacher 1 & 2</h5>
                <p>
                    Genset utama yang digunakan saat ini. Biogas dari scrubber digunakan sebagai bahan bakar.
                </p>

                <h5 class="fw-bold">• Radiator Jenbacher 1 & 2</h5>
                <p>
                    Sistem pendingin genset Jenbacher menggunakan coolant.
                </p>

                <h5 class="fw-bold">• Cooling Tower Jinan</h5>
                <p>
                    Sistem pendingin untuk genset Jinan 1 dan 3.
                </p>

            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>
