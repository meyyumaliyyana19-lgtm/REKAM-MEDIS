<?php
include 'koneksi.php';
include 'header.php';

$pesan = "";

if (isset($_POST['tambah'])) {
    $nama_obat = $_POST['nama_obat'];
    $satuan    = $_POST['satuan'];
    $stok      = $_POST['stok'];

    $sql = "INSERT INTO obat (nama_obat, satuan, stok) VALUES ('$nama_obat', '$satuan', '$stok')";
    if (mysqli_query($koneksi, $sql)) {
        $pesan = "<div class='alert alert-success alert-dismissible fade show'><i class='fa-solid fa-check-circle me-2'></i>Data obat berhasil ditambahkan!<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
    }
}

if (isset($_GET['hapus'])) {
    $id_obat = $_GET['hapus'];
    $sql_del = "DELETE FROM obat WHERE id_obat='$id_obat'";
    if (mysqli_query($koneksi, $sql_del)) {
        $pesan = "<div class='alert alert-warning alert-dismissible fade show'><i class='fa-solid fa-trash me-2'></i>Data obat berhasil dihapus!<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
    }
}

if (isset($_POST['edit'])) {
    $id_obat   = $_POST['id_obat'];
    $nama_obat = $_POST['nama_obat'];
    $satuan    = $_POST['satuan'];
    $stok      = $_POST['stok'];

    $sql_edit = "UPDATE obat SET nama_obat='$nama_obat', satuan='$satuan', stok='$stok' WHERE id_obat='$id_obat'";
    if (mysqli_query($koneksi, $sql_edit)) {
        $pesan = "<div class='alert alert-success alert-dismissible fade show'><i class='fa-solid fa-check-circle me-2'></i>Data obat berhasil diperbarui!<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
    }
}
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold text-dark"><i class="fa-solid fa-pills text-success me-2"></i>Kelola Data Obat</h3>
    <button class="btn btn-cerah-primary" data-bs-toggle="modal" data-bs-target="#modalTambahObat">
        <i class="fa-solid fa-plus me-1"></i> Tambah Obat
    </button>
</div>

<?= $pesan; ?>

<div class="card card-main p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-custom-header">
                <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Satuan</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($koneksi, "SELECT * FROM obat ORDER BY id_obat DESC");
                $no = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><strong><?= $row['nama_obat']; ?></strong></td>
                    <td><span class="badge bg-secondary"><?= $row['satuan']; ?></span></td>
                    <td><span class="badge bg-success fs-6"><?= $row['stok']; ?></span></td>
                    <td>
                        <button class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEditObat<?= $row['id_obat']; ?>">
                            <i class="fa-solid fa-pen"></i> Edit
                        </button>
                        <a href="obat.php?hapus=<?= $row['id_obat']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus obat ini?')">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </a>
                    </td>
                </tr>

                <!-- Modal Edit Obat -->
                <div class="modal fade" id="modalEditObat<?= $row['id_obat']; ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="obat.php">
                                <div class="modal-header bg-warning text-white">
                                    <h5 class="modal-title"><i class="fa-solid fa-edit me-2"></i>Edit Data Obat</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id_obat" value="<?= $row['id_obat']; ?>">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Obat</label>
                                        <input type="text" name="nama_obat" class="form-control" value="<?= $row['nama_obat']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Satuan</label>
                                        <input type="text" name="satuan" class="form-control" value="<?= $row['satuan']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Stok</label>
                                        <input type="number" name="stok" class="form-control" value="<?= $row['stok']; ?>" required>
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

<!-- Modal Tambah Obat -->
<div class="modal fade" id="modalTambahObat" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="obat.php">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="fa-solid fa-plus-circle me-2"></i>Tambah Data Obat Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Obat</label>
                        <input type="text" name="nama_obat" class="form-control" placeholder="Contoh: Paracetamol 500mg" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Satuan</label>
                        <input type="text" name="satuan" class="form-control" placeholder="Contoh: Tablet / Kapsul / Botol" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Stok</label>
                        <input type="number" name="stok" class="form-control" placeholder="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="tambah" class="btn btn-success">Simpan Obat</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>