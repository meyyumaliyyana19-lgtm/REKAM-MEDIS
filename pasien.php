<?php
include 'koneksi.php';
include 'header.php';

$pesan = "";

if (isset($_POST['tambah'])) {
    $no_rm         = mysqli_real_escape_string($koneksi, $_POST['no_rm']);
    $nama_pasien   = mysqli_real_escape_string($koneksi, $_POST['nama_pasien']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $alamat        = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    $sql = "INSERT INTO pasien (no_rm, nama_pasien, jenis_kelamin, tanggal_lahir, alamat) 
            VALUES ('$no_rm', '$nama_pasien', '$jenis_kelamin', '$tanggal_lahir', '$alamat')";
    if (mysqli_query($koneksi, $sql)) {
        $pesan = "<script>Swal.fire({icon: 'success', title: 'Registrasi Berhasil!', text: 'Data pasien baru telah terdaftar di SIMRS RSUD.', timer: 2000, showConfirmButton: false});</script>";
    }
}

if (isset($_GET['hapus'])) {
    $id_pasien = $_GET['hapus'];
    $sql_del = "DELETE FROM pasien WHERE id_pasien='$id_pasien'";
    if (mysqli_query($koneksi, $sql_del)) {
        $pesan = "<script>Swal.fire({icon: 'success', title: 'Data Dihapus!', text: 'Data pasien telah dihapus.', timer: 2000, showConfirmButton: false});</script>";
    }
}

if (isset($_POST['edit'])) {
    $id_pasien     = $_POST['id_pasien'];
    $no_rm         = mysqli_real_escape_string($koneksi, $_POST['no_rm']);
    $nama_pasien   = mysqli_real_escape_string($koneksi, $_POST['nama_pasien']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
    $alamat        = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    $sql_edit = "UPDATE pasien SET no_rm='$no_rm', nama_pasien='$nama_pasien', jenis_kelamin='$jenis_kelamin', tanggal_lahir='$tanggal_lahir', alamat='$alamat' WHERE id_pasien='$id_pasien'";
    if (mysqli_query($koneksi, $sql_edit)) {
        $pesan = "<script>Swal.fire({icon: 'success', title: 'Data Diperbarui!', text: 'Data identitas pasien berhasil diubah.', timer: 2000, showConfirmButton: false});</script>";
    }
}
?>

<?= $pesan; ?>

<div class="card-hospital-main">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h4 class="fw-bold mb-1" style="color: #0f172a;">
                <i class="fa-solid fa-hospital-user text-primary me-2"></i> Master Data Pasien RSUD
            </h4>
            <small class="text-muted">Kelola data pasien terdaftar dan nomor rekam medis unik</small>
        </div>
        <div class="d-flex gap-2">
            <input type="text" id="tableSearch" class="form-control hospital-search-input" placeholder="Cari No RM / Nama Pasien...">
            <button class="btn btn-hospital-primary text-nowrap" data-bs-toggle="modal" data-bs-target="#modalTambahPasien">
                <i class="fa-solid fa-user-plus me-1"></i> Registrasi Pasien Baru
            </button>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr class="hospital-table-header">
                    <th>No</th>
                    <th>No. RM</th>
                    <th>Nama Lengkap Pasien</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat Lengkap</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($koneksi, "SELECT * FROM pasien ORDER BY id_pasien DESC");
                $no = 1;
                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <tr>
                    <td class="fw-bold text-muted"><?= $no++; ?></td>
                    <td><span class="badge badge-hospital badge-rm"><?= $row['no_rm']; ?></span></td>
                    <td><strong style="color: #0f172a;"><?= $row['nama_pasien']; ?></strong></td>
                    <td>
                        <?= ($row['jenis_kelamin'] == 'L') 
                            ? '<span class="badge badge-hospital badge-gender-l"><i class="fa-solid fa-mars me-1"></i>Laki-Laki</span>' 
                            : '<span class="badge badge-hospital badge-gender-p"><i class="fa-solid fa-venus me-1"></i>Perempuan</span>'; ?>
                    </td>
                    <td><i class="fa-regular fa-calendar me-1 text-muted"></i><?= date('d/m/Y', strtotime($row['tanggal_lahir'])); ?></td>
                    <td><small><?= $row['alamat']; ?></small></td>
                    <td class="text-center">
                        <button class="btn-hospital-action btn-hospital-edit me-1" data-bs-toggle="modal" data-bs-target="#modalEditPasien<?= $row['id_pasien']; ?>" title="Edit Data">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <a href="pasien.php?hapus=<?= $row['id_pasien']; ?>" class="btn-hospital-action btn-hospital-delete" onclick="return confirm('Hapus data pasien ini?')" title="Hapus Data">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                </tr>

                <!-- Modal Edit Pasien -->
                <div class="modal fade" id="modalEditPasien<?= $row['id_pasien']; ?>" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form method="POST" action="pasien.php">
                                <div class="modal-header modal-header-hospital">
                                    <h5 class="modal-title"><i class="fa-solid fa-user-pen me-2 text-info"></i>Edit Data Identitas Pasien</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id_pasien" value="<?= $row['id_pasien']; ?>">
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Rekam Medis (No RM)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                            <input type="text" name="no_rm" class="form-control" value="<?= $row['no_rm']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap Pasien</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                            <input type="text" name="nama_pasien" class="form-control" value="<?= $row['nama_pasien']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-select" required>
                                                <option value="L" <?= ($row['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>Laki-laki (L)</option>
                                                <option value="P" <?= ($row['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>Perempuan (P)</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" class="form-control" value="<?= $row['tanggal_lahir']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Alamat Lengkap</label>
                                        <textarea name="alamat" class="form-control" rows="3" required><?= $row['alamat']; ?></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light border px-4" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" name="edit" class="btn btn-hospital-primary px-4"><i class="fa-solid fa-check me-1"></i> Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center py-4 text-muted'>Belum ada data pasien terdaftar.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Pasien Baru (Real SIMRS Hospital Style) -->
<div class="modal fade" id="modalTambahPasien" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="pasien.php">
                <div class="modal-header modal-header-hospital">
                    <h5 class="modal-title"><i class="fa-solid fa-user-plus me-2 text-info"></i>Registrasi Pasien Baru SIMRS</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nomor Rekam Medis (No RM)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-hashtag"></i></span>
                            <input type="text" name="no_rm" class="form-control" value="RM-2026-00<?= rand(4,99); ?>" required>
                        </div>
                        <small class="text-muted" style="font-size:0.75rem;">Nomor RM digenerate otomatis, dapat disesuaikan.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap Pasien</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                            <input type="text" name="nama_pasien" class="form-control" placeholder="Contoh: Dewa Prasetya" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                <option value="L">Laki-laki (L)</option>
                                <option value="P">Perempuan (P)</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap Pasien</label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat domisili lengkap pasien..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="tambah" class="btn btn-hospital-primary px-4"><i class="fa-solid fa-save me-1"></i> Simpan Pasien</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>