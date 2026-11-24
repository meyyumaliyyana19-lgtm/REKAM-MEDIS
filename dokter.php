<?php
include 'koneksi.php';
include 'header.php';

$pesan = "";

if (isset($_POST['tambah'])) {
    $nama_dokter  = $_POST['nama_dokter'];
    $spesialisasi = $_POST['spesialisasi'];

    $sql = "INSERT INTO dokter (nama_dokter, spesialisasi) VALUES ('$nama_dokter', '$spesialisasi')";
    if (mysqli_query($koneksi, $sql)) {
        $pesan = "<div class='alert alert-success alert-dismissible fade show'><i class='fa-solid fa-check-circle me-2'></i>Data dokter berhasil ditambahkan!<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
    }
}

if (isset($_GET['hapus'])) {
    $id_dokter = $_GET['hapus'];
    $sql_del = "DELETE FROM dokter WHERE id_dokter='$id_dokter'";
    if (mysqli_query($koneksi, $sql_del)) {
        $pesan = "<div class='alert alert-warning alert-dismissible fade show'><i class='fa-solid fa-trash me-2'></i>Data dokter berhasil dihapus!<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
    }
}

if (isset($_POST['edit'])) {
    $id_dokter    = $_POST['id_dokter'];
    $nama_dokter  = $_POST['nama_dokter'];
    $spesialisasi = $_POST['spesialisasi'];

    $sql_edit = "UPDATE dokter SET nama_dokter='$nama_dokter', spesialisasi='$spesialisasi' WHERE id_dokter='$id_dokter'";
    if (mysqli_query($koneksi, $sql_edit)) {
        $pesan = "<div class='alert alert-success alert-dismissible fade show'><i class='fa-solid fa-check-circle me-2'></i>Data dokter berhasil diperbarui!<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
    }
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold text-dark"><i class="fa-solid fa-user-doctor text-info me-2"></i>Kelola Data Dokter</h3>
    <button class="btn btn-cerah-primary" data-bs-toggle="modal" data-bs-target="#modalTambahDokter">
        <i class="fa-solid fa-plus me-1"></i> Tambah Dokter
    </button>
</div>

<?= $pesan; ?>

<div class="card card-main p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-custom-header">
                <tr>
                    <th>No</th>
                    <th>Nama Dokter</th>
                    <th>Spesialisasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($koneksi, "SELECT * FROM dokter ORDER BY id_dokter DESC");
                $no = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><strong><?= $row['nama_dokter']; ?></strong></td>
                    <td><span class="badge bg-secondary fs-6"><?= $row['spesialisasi']; ?></span></td>
                    <td>
                        <button class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEditDokter<?= $row['id_dokter']; ?>">
                            <i class="fa-solid fa-pen"></i> Edit
                        </button>
                        <a href="dokter.php?hapus=<?= $row['id_dokter']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus dokter ini?')">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </a>
                    </td>
                </tr>

                <!-- Modal Edit Dokter -->
                <div class="modal fade" id="modalEditDokter<?= $row['id_dokter']; ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="dokter.php">
                                <div class="modal-header bg-warning text-white">
                                    <h5 class="modal-title"><i class="fa-solid fa-edit me-2"></i>Edit Data Dokter</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id_dokter" value="<?= $row['id_dokter']; ?>">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Dokter</label>
                                        <input type="text" name="nama_dokter" class="form-control" value="<?= $row['nama_dokter']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Spesialisasi</label>
                                        <input type="text" name="spesialisasi" class="form-control" value="<?= $row['spesialisasi']; ?>" required>
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

<!-- Modal Tambah Dokter -->
<div class="modal fade" id="modalTambahDokter" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="dokter.php">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title"><i class="fa-solid fa-user-plus me-2"></i>Tambah Data Dokter Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap Dokter</label>
                        <input type="text" name="nama_dokter" class="form-control" placeholder="dr. Nama Dokter, Sp.X" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Spesialisasi</label>
                        <input type="text" name="spesialisasi" class="form-control" placeholder="Contoh: Spesialis Umum / Anak / Penyakit Dalam" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="tambah" class="btn btn-info text-white">Simpan Dokter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>