<?php
include "../koneksi.php";

/* =====================
   CREATE (TAMBAH)
===================== */
if (isset($_POST['simpan'])) {
    mysqli_query($conn, "INSERT INTO master_asuransi VALUES (
        '$_POST[id_asuransi]',
        '$_POST[nama_asuransi]',
        '$_POST[biaya_harian]',
        '$_POST[deskripsi]'
    )");
    header("Location: master_asuransi.php");
}

/* =====================
   UPDATE
===================== */
if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE master_asuransi SET
        nama_asuransi='$_POST[nama_asuransi]',
        biaya_harian='$_POST[biaya_harian]',
        deskripsi='$_POST[deskripsi]'
        WHERE id_asuransi='$_POST[id_asuransi]'
    ");
    header("Location: master_asuransi.php");
}

/* =====================
   DELETE
===================== */
if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM master_asuransi 
        WHERE id_asuransi='$_GET[hapus]'");
    header("Location: master_asuransi.php");
}

/* =====================
   READ DETAIL
===================== */
$detail = false;
if (isset($_GET['lihat'])) {
    $detail = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM master_asuransi 
            WHERE id_asuransi='$_GET[lihat]'")
    );
}

/* =====================
   DATA EDIT
===================== */
$edit = false;
if (isset($_GET['edit'])) {
    $edit = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM master_asuransi 
            WHERE id_asuransi='$_GET[edit]'")
    );
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Master Asuransi</title>
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
        <a href="master_asuransi.php" class="menu-item active">🛡️ Asuransi</a>
    </div>
</div>

<div class="main-content">
    <div class="top-bar">
        <h1>Master Asuransi</h1>
        <button class="btn btn-primary"
            onclick="document.getElementById('modalTambah').style.display='block'">
            ➕ Tambah Asuransi
        </button>
    </div>

    <!-- READ (TABLE) -->
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Asuransi</th>
                    <th>Biaya Harian</th>
                    <th>Deskripsi</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $q = mysqli_query($conn, "SELECT * FROM master_asuransi");
            while ($row = mysqli_fetch_assoc($q)) {
            ?>
            <tr>
                <td><?= $row['id_asuransi'] ?></td>
                <td><?= $row['nama_asuransi'] ?></td>
                <td>Rp <?= number_format($row['biaya_harian'],0,',','.') ?></td>
                <td><?= $row['deskripsi'] ?></td>
                <td style="text-align:center;">
                    <!-- READ -->
                    <a href="?lihat=<?= $row['id_asuransi'] ?>" 
                       class="btn btn-info">👁️</a>

                    <!-- UPDATE -->
                    <a href="?edit=<?= $row['id_asuransi'] ?>" 
                       class="btn btn-warning">✏️</a>

                    <!-- DELETE -->
                    <a href="?hapus=<?= $row['id_asuransi'] ?>"
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
        <h3>Tambah Asuransi</h3>
        <form method="post">
            <input type="text" name="id_asuransi" placeholder="ID Asuransi" required>
            <input type="text" name="nama_asuransi" placeholder="Nama Asuransi" required>
            <input type="number" name="biaya_harian" placeholder="Biaya Harian" required>
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
        <h3>Edit Asuransi</h3>
        <form method="post">
            <input type="hidden" name="id_asuransi" value="<?= $edit['id_asuransi'] ?>">
            <input type="text" name="nama_asuransi" value="<?= $edit['nama_asuransi'] ?>" required>
            <input type="number" name="biaya_harian" value="<?= $edit['biaya_harian'] ?>" required>
            <textarea name="deskripsi" required><?= $edit['deskripsi'] ?></textarea>
            <br><br>
            <button type="submit" name="update" class="btn btn-success">💾 Update</button>
            <button type="button" class="btn btn-secondary"
                onclick="window.location='master_asuransi.php'">
                Batal
            </button>
        </form>
    </div>
</div>
<?php } ?>

<!-- ================= MODAL DETAIL (READ) ================= -->
<?php if ($detail) { ?>
<div class="modal" style="display:block;">
    <div class="modal-content">
        <h3>Detail Asuransi</h3>

        <p><b>ID Asuransi</b><br><?= $detail['id_asuransi'] ?></p>
        <p><b>Nama Asuransi</b><br><?= $detail['nama_asuransi'] ?></p>
        <p><b>Biaya Harian</b><br>
            Rp <?= number_format($detail['biaya_harian'],0,',','.') ?>
        </p>
        <p><b>Deskripsi</b><br><?= $detail['deskripsi'] ?></p>

        <br>
        <button class="btn btn-secondary"
            onclick="window.location='master_asuransi.php'">
            Tutup
        </button>
    </div>
</div>
<?php } ?>

</body>
</html>
