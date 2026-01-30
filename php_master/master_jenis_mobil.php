<?php
include "../koneksi.php";

/* =====================
   CREATE (TAMBAH)
===================== */
if (isset($_POST['simpan'])) {
    mysqli_query($conn, "INSERT INTO master_jenis_mobil VALUES (
        '$_POST[id_jenis]',
        '$_POST[nama_jenis]',
        '$_POST[deskripsi]'
    )");
    header("Location: master_jenis_mobil.php");
}

/* =====================
   UPDATE
===================== */
if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE master_jenis_mobil SET
        nama_jenis='$_POST[nama_jenis]',
        deskripsi='$_POST[deskripsi]'
        WHERE id_jenis='$_POST[id_jenis]'
    ");
    header("Location: master_jenis_mobil.php");
}

/* =====================
   DELETE
===================== */
if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM master_jenis_mobil 
        WHERE id_jenis='$_GET[hapus]'");
    header("Location: master_jenis_mobil.php");
}

/* =====================
   READ DETAIL
===================== */
$detail = false;
if (isset($_GET['lihat'])) {
    $detail = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM master_jenis_mobil 
            WHERE id_jenis='$_GET[lihat]'")
    );
}

/* =====================
   DATA EDIT
===================== */
$edit = false;
if (isset($_GET['edit'])) {
    $edit = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM master_jenis_mobil 
            WHERE id_jenis='$_GET[edit]'")
    );
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Master Jenis Mobil</title>
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
        <a href="master_jenis_mobil.php" class="menu-item active">🚙 Jenis Mobil</a>
    </div>
</div>

<div class="main-content">
    <div class="top-bar">
        <h1>Master Jenis Mobil</h1>
        <button class="btn btn-primary"
            onclick="document.getElementById('modalTambah').style.display='block'">
            ➕ Tambah Jenis Mobil
        </button>
    </div>

    <!-- READ (TABLE) -->
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID Jenis</th>
                    <th>Nama Jenis</th>
                    <th>Deskripsi</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $q = mysqli_query($conn, "SELECT * FROM master_jenis_mobil");
            while ($row = mysqli_fetch_assoc($q)) {
            ?>
            <tr>
                <td><?= $row['id_jenis'] ?></td>
                <td><?= $row['nama_jenis'] ?></td>
                <td><?= $row['deskripsi'] ?></td>
                <td style="text-align:center;">
                    <!-- READ -->
                    <a href="?lihat=<?= $row['id_jenis'] ?>" 
                       class="btn btn-info">👁️</a>

                    <!-- UPDATE -->
                    <a href="?edit=<?= $row['id_jenis'] ?>" 
                       class="btn btn-warning">✏️</a>

                    <!-- DELETE -->
                    <a href="?hapus=<?= $row['id_jenis'] ?>"
                       onclick="return confirm('Hapus data ini?')"
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
        <h3>Tambah Jenis Mobil</h3>
        <form method="post">
            <input type="text" name="id_jenis" placeholder="ID Jenis (J16)" required>
            <input type="text" name="nama_jenis" placeholder="Nama Jenis Mobil" required>
            <textarea name="deskripsi" placeholder="Deskripsi" required></textarea>
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
        <h3>Edit Jenis Mobil</h3>
        <form method="post">
            <input type="hidden" name="id_jenis" value="<?= $edit['id_jenis'] ?>">
            <input type="text" name="nama_jenis" value="<?= $edit['nama_jenis'] ?>" required>
            <textarea name="deskripsi" required><?= $edit['deskripsi'] ?></textarea>
            <br><br>
            <button type="submit" name="update" class="btn btn-success">💾 Update</button>
            <button type="button" class="btn btn-secondary"
                onclick="window.location='master_jenis_mobil.php'">
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
        <h3>Detail Jenis Mobil</h3>

        <p><b>ID Jenis</b><br><?= $detail['id_jenis'] ?></p>
        <p><b>Nama Jenis</b><br><?= $detail['nama_jenis'] ?></p>
        <p><b>Deskripsi</b><br><?= $detail['deskripsi'] ?></p>

        <br>
        <button class="btn btn-secondary"
            onclick="window.location='master_jenis_mobil.php'">
            Tutup
        </button>
    </div>
</div>
<?php } ?>

</body>
</html>
