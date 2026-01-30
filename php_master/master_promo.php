<?php
include "../koneksi.php";

/* =====================
   CREATE
===================== */
if (isset($_POST['simpan'])) {
    mysqli_query($conn, "INSERT INTO master_promo VALUES (
        '$_POST[id_promo]',
        '$_POST[nama_promo]',
        '$_POST[diskon_persen]',
        '$_POST[syarat]'
    )");
    header("Location: master_promo.php");
}

/* =====================
   UPDATE
===================== */
if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE master_promo SET
        nama_promo='$_POST[nama_promo]',
        diskon_persen='$_POST[diskon_persen]',
        syarat='$_POST[syarat]'
        WHERE id_promo='$_POST[id_promo]'
    ");
    header("Location: master_promo.php");
}

/* =====================
   DELETE
===================== */
if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM master_promo
        WHERE id_promo='$_GET[hapus]'");
    header("Location: master_promo.php");
}

/* =====================
   READ DETAIL
===================== */
$detail = false;
if (isset($_GET['lihat'])) {
    $detail = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM master_promo
            WHERE id_promo='$_GET[lihat]'")
    );
}

/* =====================
   DATA EDIT
===================== */
$edit = false;
if (isset($_GET['edit'])) {
    $edit = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM master_promo
            WHERE id_promo='$_GET[edit]'")
    );
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Master Promo</title>
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
        <a href="master_promo.php" class="menu-item active">🎁 Promo</a>
    </div>
</div>

<div class="main-content">
    <div class="top-bar">
        <h1>Master Promo</h1>
        <button class="btn btn-primary"
            onclick="document.getElementById('modalTambah').style.display='block'">
            ➕ Tambah Promo
        </button>
    </div>

    <!-- READ -->
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID Promo</th>
                    <th>Nama Promo</th>
                    <th>Diskon (%)</th>
                    <th>Syarat</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $q = mysqli_query($conn, "SELECT * FROM master_promo");
            while ($d = mysqli_fetch_assoc($q)) {
            ?>
            <tr>
                <td><?= $d['id_promo'] ?></td>
                <td><?= $d['nama_promo'] ?></td>
                <td><?= $d['diskon_persen'] ?>%</td>
                <td><?= $d['syarat'] ?></td>
                <td style="text-align:center;">
                    <a href="?lihat=<?= $d['id_promo'] ?>" class="btn btn-info">👁️</a>
                    <a href="?edit=<?= $d['id_promo'] ?>" class="btn btn-warning">✏️</a>
                    <a href="?hapus=<?= $d['id_promo'] ?>"
                       onclick="return confirm('Hapus promo ini?')"
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
        <h3>Tambah Promo</h3>
        <form method="post">
            <input type="text" name="id_promo" placeholder="ID Promo (PR16)" required>
            <input type="text" name="nama_promo" placeholder="Nama Promo" required>
            <input type="number" name="diskon_persen" placeholder="Diskon (%)" min="0" max="100" required>
            <textarea name="syarat" placeholder="Syarat & Ketentuan" required></textarea>

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
        <h3>Edit Promo</h3>
        <form method="post">
            <input type="hidden" name="id_promo" value="<?= $edit['id_promo'] ?>">
            <input type="text" name="nama_promo" value="<?= $edit['nama_promo'] ?>" required>
            <input type="number" name="diskon_persen" value="<?= $edit['diskon_persen'] ?>" required>
            <textarea name="syarat" required><?= $edit['syarat'] ?></textarea>

            <br><br>
            <button type="submit" name="update" class="btn btn-success">💾 Update</button>
            <button type="button" class="btn btn-secondary"
                onclick="window.location='master_promo.php'">
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
        <h3>Detail Promo</h3>

        <p><b>ID Promo</b><br><?= $detail['id_promo'] ?></p>
        <p><b>Nama Promo</b><br><?= $detail['nama_promo'] ?></p>
        <p><b>Diskon</b><br><?= $detail['diskon_persen'] ?>%</p>
        <p><b>Syarat</b><br><?= $detail['syarat'] ?></p>

        <br>
        <button class="btn btn-secondary"
            onclick="window.location='master_promo.php'">
            Tutup
        </button>
    </div>
</div>
<?php } ?>

</body>
</html>
