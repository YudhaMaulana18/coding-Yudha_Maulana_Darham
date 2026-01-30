<?php
include "../koneksi.php";

/* =====================
   CREATE (TAMBAH)
===================== */
if (isset($_POST['simpan'])) {
    mysqli_query($conn, "INSERT INTO master_metode_pembayaran VALUES (
        '$_POST[id_metode]',
        '$_POST[nama_metode]',
        '$_POST[keterangan]'
    )");
    header("Location: master_metode_pembayaran.php");
}

/* =====================
   UPDATE
===================== */
if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE master_metode_pembayaran SET
        nama_metode='$_POST[nama_metode]',
        keterangan='$_POST[keterangan]'
        WHERE id_metode='$_POST[id_metode]'
    ");
    header("Location: master_metode_pembayaran.php");
}

/* =====================
   DELETE
===================== */
if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM master_metode_pembayaran
        WHERE id_metode='$_GET[hapus]'");
    header("Location: master_metode_pembayaran.php");
}

/* =====================
   READ DETAIL
===================== */
$detail = false;
if (isset($_GET['lihat'])) {
    $detail = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM master_metode_pembayaran
            WHERE id_metode='$_GET[lihat]'")
    );
}

/* =====================
   DATA EDIT
===================== */
$edit = false;
if (isset($_GET['edit'])) {
    $edit = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM master_metode_pembayaran
            WHERE id_metode='$_GET[edit]'")
    );
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Master Metode Pembayaran</title>
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
        <a href="master_metode_pembayaran.php" class="menu-item active">
            💳 Metode Pembayaran
        </a>
    </div>
</div>

<div class="main-content">
    <div class="top-bar">
        <h1>Master Metode Pembayaran</h1>
        <button class="btn btn-primary"
            onclick="document.getElementById('modalTambah').style.display='block'">
            ➕ Tambah Metode
        </button>
    </div>

    <!-- READ (TABLE) -->
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID Metode</th>
                    <th>Nama Metode</th>
                    <th>Keterangan</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $q = mysqli_query($conn, "SELECT * FROM master_metode_pembayaran");
            while ($row = mysqli_fetch_assoc($q)) {
            ?>
            <tr>
                <td><?= $row['id_metode'] ?></td>
                <td><?= $row['nama_metode'] ?></td>
                <td><?= $row['keterangan'] ?></td>
                <td style="text-align:center;">
                    <!-- READ -->
                    <a href="?lihat=<?= $row['id_metode'] ?>" class="btn btn-info">👁️</a>

                    <!-- UPDATE -->
                    <a href="?edit=<?= $row['id_metode'] ?>" class="btn btn-warning">✏️</a>

                    <!-- DELETE -->
                    <a href="?hapus=<?= $row['id_metode'] ?>"
                       onclick="return confirm('Hapus metode ini?')"
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
        <h3>Tambah Metode Pembayaran</h3>
        <form method="post">
            <input type="text" name="id_metode" placeholder="ID Metode (MP016)" required>
            <input type="text" name="nama_metode" placeholder="Nama Metode" required>
            <textarea name="keterangan" placeholder="Keterangan" required></textarea>
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
        <h3>Edit Metode Pembayaran</h3>
        <form method="post">
            <input type="hidden" name="id_metode" value="<?= $edit['id_metode'] ?>">
            <input type="text" name="nama_metode"
                   value="<?= $edit['nama_metode'] ?>" required>
            <textarea name="keterangan" required><?= $edit['keterangan'] ?></textarea>
            <br><br>
            <button type="submit" name="update" class="btn btn-success">💾 Update</button>
            <button type="button" class="btn btn-secondary"
                onclick="window.location='master_metode_pembayaran.php'">
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
        <h3>Detail Metode Pembayaran</h3>

        <p><b>ID Metode</b><br><?= $detail['id_metode'] ?></p>
        <p><b>Nama Metode</b><br><?= $detail['nama_metode'] ?></p>
        <p><b>Keterangan</b><br><?= $detail['keterangan'] ?></p>

        <br>
        <button class="btn btn-secondary"
            onclick="window.location='master_metode_pembayaran.php'">
            Tutup
        </button>
    </div>
</div>
<?php } ?>

</body>
</html>
