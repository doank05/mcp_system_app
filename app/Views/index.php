<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h1 class="fw-bold text-primary mb-4">Dashboard MCP</h1>
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

        <!-- Oli -->
        <div class="col-md-3">
        <div class="card shadow-sm border-0 text-center">
          <div class="card-body">
            <h6 class="text-muted">Ganti Oli Selanjutnya</h6>

            <?php if ($engine['oli']): ?>
              <h3 class="text-<?= $engine['oli']['status'] ?> fw-bold mb-1">
                <?= $engine['oli']['sisa_jam'] ?> Jam
              </h3>

              <div class="text-muted small">
                <?= date('d M Y', strtotime($engine['oli']['tanggal'])) ?>
              </div>

            <?php else: ?>
              <span class="text-muted">Belum ada data</span>
            <?php endif ?>

          </div>
        </div>
      </div>

        <!-- Overhaul -->
        <!-- Overhaul Selanjutnya -->
        <div class="col-md-3">
          <div class="card shadow-sm border-0 text-center">
            <div class="card-body">
              <h6 class="text-muted">Overhaul Selanjutnya</h6>

              <?php if ($engine['overhaul']): ?>
                <?php
                    $sisaJam  = $engine['overhaul']['sisa_jam'];
                    $sisaHari = ceil($sisaJam / 24);
                    $jatuhTempo = date(
                        'd M Y',
                        strtotime("+{$sisaHari} days")
                    );
                ?>

                <h3 class="text-<?= $engine['overhaul']['status'] ?> fw-bold mb-1">
                  <?= $sisaJam ?> Jam
                </h3>

                <div class="text-muted small">
                  <?= $jatuhTempo ?>
                </div>

              <?php else: ?>
                <span class="text-muted">Belum ada data</span>
              <?php endif ?>

            </div>
          </div>
        </div>


      <?php endforeach ?>
      <?php endif ?>

      <?php
      $targets = [
          'ton_tbs' => [
              'label' => 'Ton TBS Olah',
              'target' => 456000,
              'value' => $summary['ton_tbs'],
              'bar' => 'info'
          ],
          'pome' => [
              'label' => 'POME',
              'target' => 185839,
              'value' => $summary['pome'],
              'bar' => 'success'
          ],
          'umpan' => [
              'label' => 'Umpan Bioreaktor',
              'target' => 204400,
              'value' => $summary['umpan'],
              'bar' => 'success'
          ],
          'biogas' => [
              'label' => 'Produksi Biogas',
              'target' => 4905600,
              'value' => $summary['biogas'],
              'bar' => 'primary'
          ],
          'listrik' => [
              'label' => 'Produksi Daya Listrik',
              'target' => 9893074,
              'value' => $summary['listrik'],
              'bar' => 'warning'
          ],
          'kernel' => [
              'label' => 'Ton Kernel Olah',
              'target' => 41805,
              'value' => $summary['kernel'],
              'bar' => 'info'
          ],
          'kwh_biogas' => [
              'label' => 'kWh / Biogas',
              'target' => 2.10,
              'value' => $summary['kwh_biogas'],
              'bar' => 'success'
          ],
          'biogas_pome' => [
              'label' => 'Biogas / POME',
              'target' => 24,
              'value' => $summary['biogas_pome'],
              'bar' => 'secondary'
          ]
      ];
      ?>


      <!-- Progress Table -->
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">
          Realisasi Budget Tahun <?= esc($tahun) ?> (Berdasarkan BnR <?= esc($tahun) ?>)
        </div>
        <div class="card-body">
          <p class="text-center text-muted mb-3">
            Update: <strong><?= date('d-M-Y') ?></strong>
          </p>
          <div class="table-responsive">
            <table class="table table-bordered align-middle">
              <thead class="table-light">
                <tr>
                  <th>No.</th>
                  <th>Item</th>
                  <th>Realisasi</th>
                  <th>Budget 2025</th>
                  <th>Progress Bar Tahunan</th>
                  <th>%</th>
                </tr>
              </thead>
              <tbody>
              <?php $no = 1; foreach ($targets as $t): ?>
              <?php
                  $target = $t['target'];
                  $value  = $t['value'];
                  $percent = $target > 0 ? ($value / $target) * 100 : 0;
              ?>
              <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $t['label'] ?></td>
                  <td><?= number_format($value, 0) ?></td>
                  <td><?= number_format($target, 0) ?></td>

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
<?= $this->endSection() ?>
