# REKAM-MEDIS
# 🏥 SIMRS RSUD Medika Utama Tuban — Aplikasi Rekam Medis Sederhana

Proyek **Uji Kompetensi Pemrograman Web Semester Gasal** — **XII Rekayasa Perangkat Lunak (RPL)**, **SMK Negeri 3 Tuban**.  
Aplikasi **Sistem Informasi Manajemen Rekam Medis (SIMRS)** berbasis web yang dibangun menggunakan PHP Native dan MySQL/MariaDB untuk mengelola data induk pasien, dokter spesialis, stok obat farmasi, serta pencatatan riwayat pemeriksaan medis secara terintegrasi.

---

## 👤 Identitas Peserta Didik
* **Nama:** Meyyum Aliyyana Yuuhaa
* **Kelas / No. Absen:** XII ACP / 20
* **Konsentrasi Keahlian:** Rekayasa Perangkat Lunak (RPL)
* **Satuan Pendidikan:** SMK Negeri 3 Tuban

---

## ✨ Fitur-Fitur Lengkap Aplikasi

### 1. Dashboard & Monitoring Real-Time (`index.php`)
* **Statistik Agregat Otomatis:** Menghitung dan menampilkan jumlah total data **Pasien**, **Dokter Spesialis**, **Stok Obat**, dan **Catatan Medis** secara dinamis menggunakan fungsi agregat SQL `COUNT()`.
* **Ringkasan 5 Pemeriksaan Terbaru:** Menampilkan 5 riwayat pelayanan medis terakhir secara otomatis menggunakan kueri relasional `SQL JOIN` 4 tabel.
* **Navigasi Kartu Cepat:** Setiap kartu statistik terhubung langsung ke halaman modul masing-masing untuk mempercepat akses petugas.
* **Widget Informasi Rumah Sakit:** Menampilkan banner layanan terpadu, badge akreditasi **KARS Paripurna**, informasi kontak **IGD 24 Jam**, serta indikator status koneksi server SIMRS.

### 2. Manajemen Master Data Pasien (`pasien.php`)
* **Generator Nomor Rekam Medis Otomatis:** Menghasilkan format nomor RM unik (`RM-2026-00X`) secara otomatis saat registrasi pasien baru, namun tetap dapat disesuaikan manual.
* **Operasi CRUD Lengkap:** Tambah, tampil, ubah (*edit*), dan hapus data identitas pasien melalui antarmuka modal Bootstrap tanpa berpindah halaman.
* **Klasifikasi Identitas:** Pelabelan otomatis jenis kelamin (`Laki-Laki` / `Perempuan`) dengan badge visual serta format tanggal lahir standar Indonesia (`dd/mm/yyyy`).
* **Sanitasi Input & Notifikasi Interaktif:** Menggunakan `mysqli_real_escape_string()` untuk mencegah karakter berbahaya serta pop-up konfirmasi modern berbasis **SweetAlert2**.

### 3. Manajemen Master Data Dokter (`dokter.php`)
* **CRUD Data Tenaga Medis:** Pengelolaan daftar nama lengkap beserta gelar dokter dan bidang spesialisasinya (Penyakit Dalam, Anak, Umum, dll.).
* **Validasi Form & Konfirmasi Hapus:** Dilengkapi validasi kolom wajib (`required`), alert status berhasil/gagal yang dapat ditutup (*dismissible*), serta dialog konfirmasi sebelum penghapusan data.

### 4. Manajemen Data Obat & Farmasi (`obat.php`)
* **Inventori & Stok Farmasi:** Pencatatan nama obat, satuan kemasan (`Tablet`, `Kapsul`, `Botol`, `Sirup`), dan jumlah ketersediaan stok.
* **Pembaruan Stok Cepat:** Mendukung penambahan item obat baru maupun pembaruan jumlah stok secara langsung melalui modal edit.

### 5. Transaksi & Riwayat Rekam Medis (`rekam_medis.php`)
* **Dropdown Relasi Dinamis:** Pilihan **Pasien** (`No. RM - Nama`), **Dokter** (`Nama - Spesialisasi`), dan **Obat** (`Nama Obat - Sisa Stok`) ditarik langsung dari tabel master di database.
* **Sinkronisasi Pilihan pada Form Edit:** Saat mengedit catatan medis, dropdown otomatis menandai (`selected`) pasien, dokter, dan obat yang tersimpan sebelumnya.
* **Riwayat Pemeriksaan Terpadu (`SQL JOIN`):** Menggabungkan tabel `rekam_medis`, `pasien`, `dokter`, dan `obat` sehingga informasi yang tampil berupa nama deskriptif (bukan sekadar angka ID), lengkap dengan tanggal periksa, keluhan, diagnosa, tindakan medis, dan aturan resep.

### 6. Fitur Antarmuka & Utilitas Global (`header.php`, `footer.php`, `koneksi.php`)
* **Jam Digital WIB Real-Time:** Menampilkan hari, tanggal lengkap bahasa Indonesia, dan jam berjalan (`HH:MM:SS WIB`) secara *real-time* menggunakan JavaScript.
* **Pencarian Instan (*Live Table Search*):** Filter pencarian data langsung pada tabel di sisi klien (*client-side*) berdasarkan kata kunci nama pasien, No. RM, dokter, maupun diagnosa.
* **Penanganan Error Koneksi (`try-catch`):** File `koneksi.php` dilengkapi blok *exception handling* yang menampilkan pesan diagnostik yang jelas apabila layanan MySQL belum aktif atau database belum di-import.

---

## 🔄 Alur Kerja Aplikasi (*Application Workflow*)

```text
[1. INPUT DATA MASTER]
   ├── Data Pasien (pasien.php) ──► Menghasilkan id_pasien & No. RM
   ├── Data Dokter (dokter.php) ──► Menghasilkan id_dokter & Spesialisasi
   └── Data Obat   (obat.php)   ──► Menghasilkan id_obat & Stok
                 │
                 ▼
[2. TRANSAKSI PEMERIKSAAN (rekam_medis.php)]
   └── Petugas memilih Pasien, Dokter, & Obat dari Dropdown Relasi
       + Mengisi Tanggal Periksa, Keluhan, Diagnosa, Tindakan, & Resep
       + Data tersimpan ke tabel `rekam_medis` dengan Foreign Key valid
                 │
                 ▼
[3. PENYAJIAN RIWAYAT & MONITORING (index.php & rekam_medis.php)]
   ├── Kueri SQL JOIN menggabungkan 4 tabel menjadi riwayat pemeriksaan lengkap
   └── Kueri SQL COUNT() memperbarui statistik total data di Dashboard
```

### Tahapan Penggunaan Sistem:
1. **Persiapan Data Induk:** Petugas memastikan data pasien (terdaftar dengan No. RM), dokter pemeriksa, dan stok obat sudah tersedia pada masing-masing modul master.
2. **Pencatatan Pemeriksaan:** Saat pasien berobat, petugas membuka menu **Transaksi Rekam Medis**, menekan tombol **Tambah Rekam Medis**, lalu memilih pasien, dokter, dan obat melalui dropdown relasional.
3. **Pencatatan Klinis:** Petugas mengisikan tanggal pemeriksaan, keluhan utama pasien, hasil diagnosa dokter, tindakan medis yang dilakukan, serta aturan pakai resep obat.
4. **Pemantauan & Pembaruan:** Seluruh riwayat otomatis muncul pada tabel riwayat dan ringkasan **Dashboard**, serta dapat dicari, diperbarui, atau dihapus sesuai kebutuhan.

---

## 🗄️ Rancangan Database Relasional (`db_rekam_medis`)

Sistem menggunakan engine **InnoDB** pada MySQL/MariaDB dengan menerapkan normalisasi database dan integritas referensial (*Foreign Key Constraints*):

| Nama Tabel | Primary Key (PK) | Foreign Key (FK) | Atribut / Kolom Utama |
| :--- | :--- | :--- | :--- |
| **`pasien`** | `id_pasien` (INT, AI) | — | `no_rm`, `nama_pasien`, `jenis_kelamin` (`L`/`P`), `tanggal_lahir`, `alamat` |
| **`dokter`** | `id_dokter` (INT, AI) | — | `nama_dokter`, `spesialisasi` |
| **`obat`** | `id_obat` (INT, AI) | — | `nama_obat`, `satuan`, `stok` |
| **`rekam_medis`** | `id_rekam` (INT, AI) | `id_pasien`, `id_dokter`, `id_obat` | `tanggal_periksa`, `keluhan`, `diagnosa`, `tindakan`, `resep` |

### Kardinalitas Relasi:
* `pasien` $\rightarrow$ `rekam_medis` (**1 : N**) — Satu pasien dapat memiliki banyak riwayat pemeriksaan.
* `dokter` $\rightarrow$ `rekam_medis` (**1 : N**) — Satu dokter dapat menangani banyak pemeriksaan pasien.
* `obat` $\rightarrow$ `rekam_medis` (**1 : N**) — Satu jenis obat dapat diresepkan pada banyak transaksi medis.

---

## 🛠️ Tahapan Pembuatan Aplikasi

1. **Analisis Kebutuhan & Perancangan Basis Data:**
   * Mengidentifikasi entitas utama SIMRS (`pasien`, `dokter`, `obat`, `rekam_medis`).
   * Merancang *Entity Relationship Diagram* (ERD), menentukan tipe data, *Primary Key* (`AUTO_INCREMENT`), dan relasi *Foreign Key* dengan aturan `ON DELETE CASCADE`.
2. **Konfigurasi Lingkungan Pengembangan:**
   * Menyiapkan web server lokal menggunakan **XAMPP** (Apache & MariaDB/MySQL) dan membuat database `db_rekam_medis` melalui phpMyAdmin.
3. **Pembuatan Modul Koneksi & Tata Letak UI:**
   * Membangun `koneksi.php` menggunakan ekstensi `mysqli` dengan mekanisme `try-catch`.
   * Merancang komponen antarmuka modular `header.php` dan `footer.php` menggunakan **Bootstrap 5.3**, **FontAwesome 6**, **Google Fonts (Inter & Poppins)**, serta skrip jam digital *real-time*.
4. **Implementasi Fitur CRUD & Relasi Database:**
   * Mengembangkan halaman CRUD untuk modul master (`pasien.php`, `dokter.php`, `obat.php`).
   * Membangun modul transaksi `rekam_medis.php` dengan dropdown berbasis kueri `SELECT` tabel induk serta tampilan riwayat menggunakan `INNER JOIN`.
5. **Pengembangan Dashboard & Interaktivitas:**
   * Mengintegrasikan kueri agregat `COUNT()` pada `index.php` serta menambahkan fitur pencarian tabel instan dan konfirmasi **SweetAlert2**.
6. **Pengujian Fungsional & Dokumentasi:**
   * Menguji seluruh skenario tambah, tampil, ubah, hapus, validasi relasi *Foreign Key*, serta mengekspor database ke dalam file `.sql`.

---

## 📁 Struktur File Proyek

```text
REKAM-MEDIS/
├── db_rekam_medis_2.sql # File ekspor struktur tabel, relasi FK, & data uji database
├── dokter.php           # Modul CRUD master data dokter
├── footer.php           # Komponen footer, library JS, live clock, & filter pencarian
├── header.php           # Komponen navbar, logo SVG RSUD, & konfigurasi CSS tema
├── index.php            # Halaman Dashboard statistik & 5 riwayat pemeriksaan terbaru
├── koneksi.php          # Konfigurasi koneksi database MySQLi & error handling
├── obat.php             # Modul CRUD master data obat & stok farmasi
├── pasien.php           # Modul CRUD master data pasien & generator No. RM
├── rekam_medis.php      # Modul transaksi & riwayat rekam medis (SQL JOIN)
└── README.md            # Dokumentasi lengkap proyek
```

---

## 💻 Teknologi yang Digunakan
* **Bahasa Pemrograman:** PHP 8.2 (Native)
* **Sistem Manajemen Basis Data:** MySQL / MariaDB 10.11 (InnoDB)
* **Frontend & Styling:** HTML5, CSS3, Bootstrap 5.3.2
* **Ikon & Alert Library:** FontAwesome 6.4.2, SweetAlert2
* **Server Lokal:** XAMPP Control Panel

---

## 🚀 Cara Instalasi & Menjalankan di Lokal (XAMPP)

1. **Unduh / Clone Repositori:**
   ```bash
   git clone [https://github.com/meyyumaliyyana19-lgtm/REKAM-MEDIS.git](https://github.com/meyyumaliyyana19-lgtm/REKAM-MEDIS.git)
   ```
   Letakkan folder proyek ke dalam direktori `C:\xampp\htdocs\`.
2. **Aktifkan Server Lokal:**
   Buka **XAMPP Control Panel**, lalu klik **Start** pada modul **Apache** dan **MySQL**.
3. **Import Database:**
   * Buka browser dan akses `http://localhost/phpmyadmin`.
   * Buat database baru dengan nama **`db_rekam_medis`**.
   * Pilih database tersebut, buka tab **Import**, pilih file `.sql` yang tersedia di repositori ini, lalu klik **Import / Go**.
4. **Sesuaikan Konfigurasi Koneksi:**
   Buka file **`koneksi.php`** dan pastikan kredensial sesuai dengan server lokal Anda (default XAMPP: `$user = "root"; $pass = "";`).
5. **Jalankan Aplikasi:**
   Buka browser dan akses `http://localhost/REKAM-MEDIS/` (sesuaikan dengan nama folder di dalam `htdocs`).
