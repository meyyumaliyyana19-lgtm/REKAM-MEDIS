<?php
include 'koneksi.php';
include 'header.php';

$pesan = "";

// Handle Tambah Rekam Medis
if (isset($_POST['tambah'])) {
    $id_pasien       = $_POST['id_pasien'];
    $id_dokter       = $_POST['id_dokter'];
    $id_obat         = $_POST['id_obat'];
    $tanggal_periksa = $_POST['tanggal_periksa'];
    $keluhan         = $_POST['keluhan'];
    $diagnosa        = $_POST['diagnosa'];
    $tindakan        = $_POST['tindakan'];
    $resep           = $_POST['resep'];

    $sql = "INSERT INTO rekam_medis (id_pasien, id_dokter, id_obat, tanggal_periksa, keluhan, diagnosa, tindakan, resep) 
            VALUES ('$id_pasien', '$id_dokter', '$id_obat', '$tanggal_periksa', '$keluhan', '$diagnosa', '$tindakan', '$resep')";
    if (mysqli_query($koneksi, $sql)) {
        $pesan = "<div class='alert alert-success alert-dismissible fade show'><i class='fa-solid fa-check-circle me-2'></i>Data rekam medis berhasil disimpan!<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
    } else {
        $pesan = "<div class='alert alert-danger alert-dismissible fade show'><i class='fa-solid fa-exclamation-circle me-2'></i>Gagal menyimpan data: ".mysqli_error($koneksi)."<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
    }
}

// Handle Hapus Rekam Medis
if (isset($_GET['hapus'])) {
    $id_rekam = $_GET['hapus'];
    $sql_del = "DELETE FROM rekam_medis WHERE id_rekam='$id_rekam'";
    if (mysqli_query($koneksi, $sql_del)) {
        $pesan = "<div class='alert alert-warning alert-dismissible fade show'><i class='fa-solid fa-trash me-2'></i>Catatan rekam medis dihapus!<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
    }
}

// Handle Edit Rekam Medis
if (isset($_POST['edit'])) {
    $id_rekam        = $_POST['id_rekam'];
    $id_pasien       = $_POST['id_pasien'];
    $id_dokter       = $_POST['id_dokter'];
    $id_obat         = $_POST['id_obat'];
    $tanggal_periksa = $_POST['tanggal_periksa'];
    $keluhan         = $_POST['keluhan'];
    $diagnosa        = $_POST['diagnosa'];
    $tindakan        = $_POST['tindakan'];
    $resep           = $_POST['resep'];

    $sql_edit = "UPDATE rekam_medis SET id_pasien='$id_pasien', id_dokter='$id_dokter', id_obat='$id_obat', tanggal_periksa='$tanggal_periksa', keluhan='$keluhan', diagnosa='$diagnosa', tindakan='$tindakan', resep='$resep' WHERE id_rekam='$id_rekam'";
    if (mysqli_query($koneksi, $sql_edit)) {
        $pesan = "<div class='alert alert-success alert-dismissible fade show'><i class='fa-solid fa-check-circle me-2'></i>Catatan rekam medis diperbarui!<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
    }
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold text-dark"><i class="fa-solid fa-file-medical me-2 text-primary"></i>Riwayat & Pendaftaran Rekam Medis</h3>
    <button class="btn btn-cerah-primary" data-bs-toggle="modal" data-bs-target="#modalTambahRekam">
        <i class="fa-solid fa-plus me-1"></i> Tambah Rekam Medis
    </button>
</div>

<?= $pesan; ?>

<div class="card card-main p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-custom-header">
                <tr>
                    <th>No</th>
                    <th>Tgl Periksa</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Obat</th>
                    <th>Keluhan</th>
                    <th>Diagnosa</th>
                    <th>Tindakan & Resep</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // MENGGUNAKAN SQL JOIN SESUAI KETENTUAN LKPD
                $sql_join = "SELECT rm.*, p.nama_pasien, p.no_rm, d.nama_dokter, o.nama_obat 
                             FROM rekam_medis rm
                             JOIN pasien p ON rm.id_pasien = p.id_pasien
                             JOIN dokter d ON rm.id_dokter = d.id_dokter
                             JOIN obat o ON rm.id_obat = o.id_obat
                             ORDER BY rm.id_rekam DESC";
                $res = mysqli_query($koneksi, $sql_join);
                $no = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= date('d-m-Y', strtotime($row['tanggal_periksa'])); ?></td>
                    <td>
                        <strong><?= $row['nama_pasien']; ?></strong><br>
                        <small class="text-muted"><?= $row['no_rm']; ?></small>
                    </td>
                    <td><?= $row['nama_dokter']; ?></td>
                    <td><span class="badge bg-success"><?= $row['nama_obat']; ?></span></td>
                    <td><?= $row['keluhan']; ?></td>
                    <td><span class="badge bg-primary"><?= $row['diagnosa']; ?></span></td>
                    <td>
                        <small><strong>Tindakan:</strong> <?= $row['tindakan']; ?></small><br>
                        <small><strong>Resep:</strong> <?= $row['resep']; ?></small>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-warning text-white mb-1" data-bs-toggle="modal" data-bs-target="#modalEditRM<?= $row['id_rekam']; ?>">
                            <i class="fa-solid fa-pen"></i> Edit
                        </button>
                        <a href="rekam_medis.php?hapus=<?= $row['id_rekam']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus rekam medis ini?')">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </a>
                    </td>
                </tr>

                <!-- Modal Edit Rekam Medis -->
                <div class="modal fade" id="modalEditRM<?= $row['id_rekam']; ?>" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form method="POST" action="rekam_medis.php">
                                <div class="modal-header bg-warning text-white">
                                    <h5 class="modal-title"><i class="fa-solid fa-edit me-2"></i>Edit Catatan Rekam Medis</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id_rekam" value="<?= $row['id_rekam']; ?>">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tanggal Periksa</label>
                                            <input type="date" name="tanggal_periksa" class="form-control" value="<?= $row['tanggal_periksa']; ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Pasien (Dropdown Database)</label>
                                            <select name="id_pasien" class="form-select" required>
                                                <?php
                                                $q_p = mysqli_query($koneksi, "SELECT * FROM pasien");
                                                while($p = mysqli_fetch_assoc($q_p)) {
                                                    $sel = ($p['id_pasien'] == $row['id_pasien']) ? 'selected' : '';
                                                    echo "<option value='{$p['id_pasien']}' {$sel}>{$p['no_rm']} - {$p['nama_pasien']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Dokter (Dropdown Database)</label>
                                            <select name="id_dokter" class="form-select" required>
                                                <?php
                                                $q_d = mysqli_query($koneksi, "SELECT * FROM dokter");
                                                while($d = mysqli_fetch_assoc($q_d)) {
                                                    $sel = ($d['id_dokter'] == $row['id_dokter']) ? 'selected' : '';
                                                    echo "<option value='{$d['id_dokter']}' {$sel}>{$d['nama_dokter']}</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Obat (Dropdown Database)</label>
                                            <select name="id_obat" class="form-select" required>
                                                <?php
                                                $q_o = mysqli_query($koneksi, "SELECT * FROM obat");
                                                while($o = mysqli_fetch_assoc($q_o)) {
                                                    $sel = ($o['id_obat'] == $row['id_obat']) ? 'selected' : '';
                                                    echo "<option value='{$o['id_obat']}' {$sel}>{$o['nama_obat']} (Stok: {$o['stok']})</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Keluhan</label>
                                            <textarea name="keluhan" class="form-control" rows="2" required><?= $row['keluhan']; ?></textarea>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Diagnosa</label>
                                            <textarea name="diagnosa" class="form-control" rows="2" required><?= $row['diagnosa']; ?></textarea>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tindakan</label>
                                            <textarea name="tindakan" class="form-control" rows="2" required><?= $row['tindakan']; ?></textarea>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Resep / Aturan Pakai</label>
                                            <input type="text" name="resep" class="form-control" value="<?= $row['resep']; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" name="edit" class="btn btn-warning text-white">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Rekam Medis -->
<div class="modal fade" id="modalTambahRekam" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="rekam_medis.php">
                <div class="modal-header text-white" style="background: linear-gradient(135deg, #8E2DE2 0%, #4A00E0 100%);">
                    <h5 class="modal-title"><i class="fa-solid fa-notes-medical me-2"></i>Tambah Rekam Medis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Periksa</label>
                            <input type="date" name="tanggal_periksa" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pasien (Dropdown Relasi)</label>
                            <select name="id_pasien" class="form-select" required>
                                <option value="">-- Pilih Pasien --</option>
                                <?php
                                $q_p = mysqli_query($koneksi, "SELECT * FROM pasien");
                                while($p = mysqli_fetch_assoc($q_p)) {
                                    echo "<option value='{$p['id_pasien']}'>{$p['no_rm']} - {$p['nama_pasien']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Dokter (Dropdown Relasi)</label>
                            <select name="id_dokter" class="form-select" required>
                                <option value="">-- Pilih Dokter --</option>
                                <?php
                                $q_d = mysqli_query($koneksi, "SELECT * FROM dokter");
                                while($d = mysqli_fetch_assoc($q_d)) {
                                    echo "<option value='{$d['id_dokter']}'>{$d['nama_dokter']} ({$d['spesialisasi']})</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Obat (Dropdown Relasi)</label>
                            <select name="id_obat" class="form-select" required>
                                <option value="">-- Pilih Obat --</option>
                                <?php
                                $q_o = mysqli_query($koneksi, "SELECT * FROM obat");
                                while($o = mysqli_fetch_assoc($q_o)) {
                                    echo "<option value='{$o['id_obat']}'>{$o['nama_obat']} (Stok: {$o['stok']})</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Keluhan</label>
                            <textarea name="keluhan" class="form-control" rows="2" placeholder="Keluhan utama pasien" required></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Diagnosa</label>
                            <textarea name="diagnosa" class="form-control" rows="2" placeholder="Hasil diagnosa dokter" required></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tindakan</label>
                            <textarea name="tindakan" class="form-control" rows="2" placeholder="Tindakan medis yang diberikan" required></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Resep / Aturan Pakai</label>
                            <input type="text" name="resep" class="form-control" placeholder="Contoh: 3x1 tablet sesudah makan" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="tambah" class="btn text-white" style="background: linear-gradient(135deg, #8E2DE2 0%, #4A00E0 100%);">Simpan Rekam Medis</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>