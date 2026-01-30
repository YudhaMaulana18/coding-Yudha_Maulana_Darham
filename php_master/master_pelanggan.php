<?php
include "../koneksi.php";

/* =====================
   CREATE
===================== */
if (isset($_POST['simpan'])) {
    mysqli_query($conn, "INSERT INTO master_pelanggan VALUES (
        '$_POST[id_pelanggan]',
        '$_POST[nama_pelanggan]',
        '$_POST[no_hp]',
        '$_POST[alamat]',
        '$_POST[email]'
    )");
    header("Location: master_pelanggan.php");
}

/* =====================
   UPDATE
===================== */
if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE master_pelanggan SET
        nama_pelanggan='$_POST[nama_pelanggan]',
        no_hp='$_POST[no_hp]',
        alamat='$_POST[alamat]',
        email='$_POST[email]'
        WHERE id_pelanggan='$_POST[id_pelanggan]'
    ");
    header("Location: master_pelanggan.php");
}

/* =====================
   DELETE
===================== */
if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM master_pelanggan
        WHERE id_pelanggan='$_GET[hapus]'");
    header("Location: master_pelanggan.php");
}

/* =====================
   READ DETAIL
===================== */
$detail = false;
if (isset($_GET['lihat'])) {
    $detail = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM master_pelanggan
            WHERE id_pelanggan='$_GET[lihat]'")
    );
}

/* =====================
   DATA EDIT
===================== */
$edit = false;
if (isset($_GET['edit'])) {
    $edit = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM master_pelanggan
            WHERE id_pelanggan='$_GET[edit]'")
    );
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Master Pelanggan</title>
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
        <a href="master_pelanggan.php" class="menu-item active">👥 Pelanggan</a>
    </div>
</div>

<div class="main-content">
    <div class="top-bar">
        <h1>Master Pelanggan</h1>
        <button class="btn btn-primary"
            onclick="document.getElementById('modalTambah').style.display='block'">
            ➕ Tambah Pelanggan
        </button>
    </div>

    <!-- READ -->
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $q = mysqli_query($conn, "SELECT * FROM master_pelanggan");
            while ($d = mysqli_fetch_assoc($q)) {
            ?>
            <tr>
                <td><?= $d['id_pelanggan'] ?></td>
                <td><?= $d['nama_pelanggan'] ?></td>
                <td><?= $d['no_hp'] ?></td>
                <td><?= $d['alamat'] ?></td>
                <td><?= $d['email'] ?></td>
                <td style="text-align:center;">
                    <a href="?lihat=<?= $d['id_pelanggan'] ?>" class="btn btn-info">👁️</a>
                    <a href="?edit=<?= $d['id_pelanggan'] ?>" class="btn btn-warning">✏️</a>
                    <a href="?hapus=<?= $d['id_pelanggan'] ?>"
                       onclick="return confirm('Hapus pelanggan ini?')"
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
        <h3>Tambah Pelanggan</h3>
        <form method="post">
            <input type="text" name="id_pelanggan" placeholder="ID Pelanggan (P016)" required>
            <input type="text" name="nama_pelanggan" placeholder="Nama Lengkap" required>
            <input type="text" name="no_hp" placeholder="No HP" required>
            <textarea name="alamat" placeholder="Alamat Lengkap" required></textarea>
            <input type="email" name="email" placeholder="Email" required>

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
        <h3>Edit Pelanggan</h3>
        <form method="post">
            <input type="hidden" name="id_pelanggan" value="<?= $edit['id_pelanggan'] ?>">

            <input type="text" name="nama_pelanggan"
                   value="<?= $edit['nama_pelanggan'] ?>" required>
            <input type="text" name="no_hp"
                   value="<?= $edit['no_hp'] ?>" required>
            <textarea name="alamat" required><?= $edit['alamat'] ?></textarea>
            <input type="email" name="email"
                   value="<?= $edit['email'] ?>" required>

            <br><br>
            <button type="submit" name="update" class="btn btn-success">💾 Update</button>
            <button type="button" class="btn btn-secondary"
                onclick="window.location='master_pelanggan.php'">
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
        <h3>Detail Pelanggan</h3>

        <p><b>ID Pelanggan</b><br><?= $detail['id_pelanggan'] ?></p>
        <p><b>Nama</b><br><?= $detail['nama_pelanggan'] ?></p>
        <p><b>No HP</b><br><?= $detail['no_hp'] ?></p>
        <p><b>Alamat</b><br><?= $detail['alamat'] ?></p>
        <p><b>Email</b><br><?= $detail['email'] ?></p>

        <br>
        <button class="btn btn-secondary"
            onclick="window.location='master_pelanggan.php'">
            Tutup
        </button>
    </div>
</div>
<?php } ?>

</body>
</html>
