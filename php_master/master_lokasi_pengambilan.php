<?php
include "../koneksi.php";

/* =====================
   CREATE (TAMBAH)
===================== */
if (isset($_POST['simpan'])) {
    mysqli_query($conn, "INSERT INTO master_lokasi_pengambilan VALUES (
        '$_POST[id_lokasi]',
        '$_POST[nama_lokasi]',
        '$_POST[alamat]',
        '$_POST[kota]'
    )");
    header("Location: master_lokasi_pengambilan.php");
}

/* =====================
   UPDATE
===================== */
if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE master_lokasi_pengambilan SET
        nama_lokasi='$_POST[nama_lokasi]',
        alamat='$_POST[alamat]',
        kota='$_POST[kota]'
        WHERE id_lokasi='$_POST[id_lokasi]'
    ");
    header("Location: master_lokasi_pengambilan.php");
}

/* =====================
   DELETE
===================== */
if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM master_lokasi_pengambilan 
        WHERE id_lokasi='$_GET[hapus]'");
    header("Location: master_lokasi_pengambilan.php");
}

/* =====================
   READ DETAIL
===================== */
$detail = false;
if (isset($_GET['lihat'])) {
    $detail = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM master_lokasi_pengambilan 
            WHERE id_lokasi='$_GET[lihat]'")
    );
}

/* =====================
   DATA EDIT
===================== */
$edit = false;
if (isset($_GET['edit'])) {
    $edit = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM master_lokasi_pengambilan 
            WHERE id_lokasi='$_GET[edit]'")
    );
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Master Lokasi Pengambilan</title>
    <link rel="stylesheet" href="../css_master/master_SCTV.css">
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">
        <h2>🚗 RENTAL MOBIL</h2>
        <p>Sistem Manajemen</p>
    </div>
    <a href="../dasbor/jasa sewa.php" class="menu-item">📊 Dashboard</a>
    <div class="menu-section">
        <div class="menu-title">MASTER DATA</div>
        <a href="master_lokasi_pengambilan.php" class="menu-item active">
            📍 Lokasi Pengambilan
        </a>
    </div>
</div>

<div class="main-content">
    <div class="top-bar">
        <h1>Master Lokasi Pengambilan</h1>
        <button class="btn btn-primary"
            onclick="document.getElementById('modalTambah').style.display='block'">
            ➕ Tambah Lokasi
        </button>
    </div>

    <!-- READ (TABLE) -->
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID Lokasi</th>
                    <th>Nama Lokasi</th>
                    <th>Alamat</th>
                    <th>Kota</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $q = mysqli_query($conn, "SELECT * FROM master_lokasi_pengambilan");
            while ($row = mysqli_fetch_assoc($q)) {
            ?>
            <tr>
                <td><?= $row['id_lokasi'] ?></td>
                <td><?= $row['nama_lokasi'] ?></td>
                <td><?= $row['alamat'] ?></td>
                <td><?= $row['kota'] ?></td>
                <td style="text-align:center;">
                    <!-- READ -->
                    <a href="?lihat=<?= $row['id_lokasi'] ?>" 
                       class="btn btn-info">👁️</a>

                    <!-- UPDATE -->
                    <a href="?edit=<?= $row['id_lokasi'] ?>" 
                       class="btn btn-warning">✏️</a>

                    <!-- DELETE -->
                    <a href="?hapus=<?= $row['id_lokasi'] ?>"
                       onclick="return confirm('Hapus lokasi ini?')"
                       class="btn btn-danger">🗑️</a>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ================= MODAL TAMBAH ================= -->
<div class="modal" id="modalTambah" style="display:none;">
    <div class="modal-content">
        <h3>Tambah Lokasi Pengambilan</h3>
        <form method="post">
            <input type="text" name="id_lokasi" placeholder="ID Lokasi (L016)" required>
            <input type="text" name="nama_lokasi" placeholder="Nama Lokasi" required>
            <textarea name="alamat" placeholder="Alamat Lengkap" required></textarea>
            <input type="text" name="kota" placeholder="Kota" required>
            <br><br>
            <button type="submit" name="simpan" class="btn btn-success">💾 Simpan</button>
            <button type="button" class="btn btn-secondary"
                onclick="document.getElementById('modalTambah').style.display='none'">
                Batal
            </button>
        </form>
    </div>
</div>

<!-- ================= MODAL EDIT ================= -->
<?php if ($edit) { ?>
<div class="modal" style="display:block;">
    <div class="modal-content">
        <h3>Edit Lokasi Pengambilan</h3>
        <form method="post">
            <input type="hidden" name="id_lokasi" value="<?= $edit['id_lokasi'] ?>">
            <input type="text" name="nama_lokasi" value="<?= $edit['nama_lokasi'] ?>" required>
            <textarea name="alamat" required><?= $edit['alamat'] ?></textarea>
            <input type="text" name="kota" value="<?= $edit['kota'] ?>" required>
            <br><br>
            <button type="submit" name="update" class="btn btn-success">💾 Update</button>
            <button type="button" class="btn btn-secondary"
                onclick="window.location='master_lokasi_pengambilan.php'">
                Batal
            </button>
        </form>
    </div>
</div>
<?php } ?>

<!-- ================= MODAL DETAIL ================= -->
<?php if ($detail) { ?>
<div class="modal" style="display:block;">
    <div class="modal-content">
        <h3>Detail Lokasi Pengambilan</h3>

        <p><b>ID Lokasi</b><br><?= $detail['id_lokasi'] ?></p>
        <p><b>Nama Lokasi</b><br><?= $detail['nama_lokasi'] ?></p>
        <p><b>Alamat</b><br><?= $detail['alamat'] ?></p>
        <p><b>Kota</b><br><?= $detail['kota'] ?></p>

        <br>
        <button class="btn btn-secondary"
            onclick="window.location='master_lokasi_pengambilan.php'">
            Tutup
        </button>
    </div>
</div>
<?php } ?>

</body>
</html>
