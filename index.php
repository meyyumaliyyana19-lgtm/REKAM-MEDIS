<?php
include 'koneksi.php';
include 'header.php';

$q_pasien = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pasien");
$d_pasien = mysqli_fetch_assoc($q_pasien);

$q_dokter = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM dokter");
$d_dokter = mysqli_fetch_assoc($q_dokter);

$q_obat   = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM obat");
$d_obat   = mysqli_fetch_assoc($q_obat);

$q_rekam  = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM rekam_medis");
$d_rekam  = mysqli_fetch_assoc($q_rekam);
?>

<!-- Banner SIMRS RSUD Medika Utama Tuban -->
<div class="hospital-banner mb-4">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                <span class="badge bg-info text-dark fw-bold px-3 py-2"><i class="fa-solid fa-hospital-user me-1"></i> RSUD MEDIKA UTAMA TUBAN</span>
                <span class="badge bg-light text-dark fw-bold px-3 py-2 shadow-sm"><i class="fa-solid fa-clock text-primary me-1"></i> <span id="dashboardClock">00:00:00 WIB</span></span>
                <span class="badge bg-success text-white fw-bold px-3 py-2"><i class="fa-solid fa-calendar-day me-1"></i> <span id="dashboardDate">-- Hari --</span></span>
            </div>
            <h2 class="fw-bold mb-2" style="font-family: 'Poppins', sans-serif;">Pusat Pelayanan Rekam Medis Terpadu</h2>
            <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                Selamat Datang di SIMRS RSUD Medika Utama Tuban. Kelola pendaftaran pasien, jadwal dokter spesialis, stok obat farmasi, serta pencatatan diagnosa medis secara efisien dan real-time.
            </p>
        </div>
        <div class="col-lg-4 text-end d-none d-lg-block">
            <a href="rekam_medis.php" class="btn btn-light btn-lg font-weight-bold text-primary px-4 py-3 shadow-sm rounded-3">
                <i class="fa-solid fa-plus-circle me-2"></i> Input Rekam Medis
            </a>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <a href="pasien.php" class="card-hospital-stat">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="stat-title">Total Pasien</span>
                <div class="stat-icon-wrapper bg-icon-pasien">
                    <i class="fa-solid fa-hospital-user"></i>
                </div>
            </div>
            <div class="stat-value"><?= $d_pasien['total']; ?></div>
            <div class="text-muted mt-2" style="font-size: 0.78rem;">
                <i class="fa-solid fa-arrow-right-long text-primary me-1"></i> Data Pasien
            </div>
        </a>
    </div>

    <div class="col-6 col-md-3">
        <a href="dokter.php" class="card-hospital-stat">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="stat-title">Dokter Spesialis</span>
                <div class="stat-icon-wrapper bg-icon-dokter">
                    <i class="fa-solid fa-user-doctor"></i>
                </div>
            </div>
            <div class="stat-value"><?= $d_dokter['total']; ?></div>
            <div class="text-muted mt-2" style="font-size: 0.78rem;">
                <i class="fa-solid fa-arrow-right-long text-teal me-1"></i> Tim Dokter
            </div>
        </a>
    </div>

    <div class="col-6 col-md-3">
        <a href="obat.php" class="card-hospital-stat">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="stat-title">Stok Obat</span>
                <div class="stat-icon-wrapper bg-icon-obat">
                    <i class="fa-solid fa-pills"></i>
                </div>
            </div>
            <div class="stat-value"><?= $d_obat['total']; ?></div>
            <div class="text-muted mt-2" style="font-size: 0.78rem;">
                <i class="fa-solid fa-arrow-right-long text-warning me-1"></i> Inventori Farmasi
            </div>
        </a>
    </div>

    <div class="col-6 col-md-3">
        <a href="rekam_medis.php" class="card-hospital-stat">
            <div class="d-flex align-items-center justify-content-between mb-2">
                <span class="stat-title">Catatan Medis</span>
                <div class="stat-icon-wrapper bg-icon-rekam">
                    <i class="fa-solid fa-notes-medical"></i>
                </div>
            </div>
            <div class="stat-value"><?= $d_rekam['total']; ?></div>
            <div class="text-muted mt-2" style="font-size: 0.78rem;">
                <i class="fa-solid fa-arrow-right-long text-purple me-1"></i> Riwayat Periksa
            </div>
        </a>
    </div>
</div>

<div class="card-hospital-main">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3">
        <div>
            <h5 class="fw-bold mb-1" style="color: #0f172a;">
                <i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i> 5 Pemeriksaan Pasien Terbaru
            </h5>
            <small class="text-muted">Menampilkan ringkasan pelayanan rekam medis pasien RSUD Medika Utama</small>
        </div>
        <div class="d-flex align-items-center gap-2">
            <input type="text" id="tableSearch" class="form-control hospital-search-input" placeholder="Cari data pasien / dokter...">
            <a href="rekam_medis.php" class="btn btn-outline-primary btn-sm px-3 rounded-2 text-nowrap">Lihat Semua</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr class="hospital-table-header">
                    <th>No</th>
                    <th>Tgl Periksa</th>
                    <th>No. RM</th>
                    <th>Nama Pasien</th>
                    <th>Dokter Pemeriksa</th>
                    <th>Obat Diperoleh</th>
                    <th>Diagnosa Utama</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_recent = "SELECT rm.tanggal_periksa, p.no_rm, p.nama_pasien, d.nama_dokter, o.nama_obat, rm.diagnosa
                               FROM rekam_medis rm
                               JOIN pasien p ON rm.id_pasien = p.id_pasien
                               JOIN dokter d ON rm.id_dokter = d.id_dokter
                               JOIN obat o ON rm.id_obat = o.id_obat
                               ORDER BY rm.id_rekam DESC LIMIT 5";
                $res_recent = mysqli_query($koneksi, $sql_recent);
                $no = 1;

                if (mysqli_num_rows($res_recent) > 0) {
                    while ($row = mysqli_fetch_assoc($res_recent)) {
                        echo "<tr>
                                <td class='fw-bold text-muted'>{$no}</td>
                                <td><i class='fa-regular fa-calendar me-1 text-muted'></i>".date('d/m/Y', strtotime($row['tanggal_periksa']))."</td>
                                <td><span class='badge badge-hospital badge-rm'>{$row['no_rm']}</span></td>
                                <td><strong style='color:#0f172a;'>{$row['nama_pasien']}</strong></td>
                                <td><span class='badge badge-hospital badge-dokter'><i class='fa-solid fa-user-doctor me-1'></i>{$row['nama_dokter']}</span></td>
                                <td><span class='badge badge-hospital badge-obat'><i class='fa-solid fa-capsules me-1'></i>{$row['nama_obat']}</span></td>
                                <td><span class='fw-medium text-dark'>{$row['diagnosa']}</span></td>
                                <td class='text-center'><span class='badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1'><i class='fa-solid fa-check-circle me-1'></i> Selesai</span></td>
                              </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center py-4 text-muted'><i class='fa-solid fa-folder-open fa-2x mb-2 d-block'></i>Belum ada data rekam medis yang dicatat.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>