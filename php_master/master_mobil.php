<?php
include "../koneksi.php";

/* =====================
   CREATE
===================== */
if (isset($_POST['simpan'])) {
    mysqli_query($conn, "INSERT INTO master_mobil VALUES (
        '$_POST[id_mobil]',
        '$_POST[id_jenis]',
        '$_POST[merk]',
        '$_POST[model]',
        '$_POST[tahun]',
        '$_POST[harga]',
        '$_POST[status]'
    )");
    header("Location: master_mobil.php");
}

/* =====================
   UPDATE
===================== */
if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE master_mobil SET
        id_jenis='$_POST[id_jenis]',
        merk='$_POST[merk]',
        model='$_POST[model]',
        tahun='$_POST[tahun]',
        harga_sewa_per_hari='$_POST[harga]',
        status='$_POST[status]'
        WHERE id_mobil='$_POST[id_mobil]'
    ");
    header("Location: master_mobil.php");
}

/* =====================
   DELETE
===================== */
if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM master_mobil
        WHERE id_mobil='$_GET[hapus]'");
    header("Location: master_mobil.php");
}

/* =====================
   READ DETAIL
===================== */
$detail = false;
if (isset($_GET['lihat'])) {
    $detail = mysqli_fetch_assoc(mysqli_query($conn, "
        SELECT m.*, j.nama_jenis
        FROM master_mobil m
        LEFT JOIN master_jenis_mobil j ON m.id_jenis=j.id_jenis
        WHERE m.id_mobil='$_GET[lihat]'
    "));
}

/* =====================
   DATA EDIT
===================== */
$edit = false;
if (isset($_GET['edit'])) {
    $edit = mysqli_fetch_assoc(mysqli_query($conn, "
        SELECT * FROM master_mobil
        WHERE id_mobil='$_GET[edit]'
    "));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Master Mobil</title>
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
        <a href="master_mobil.php" class="menu-item active">🚘 Data Mobil</a>
    </div>
</div>

<div class="main-content">
    <div class="top-bar">
        <h1>Master Data Mobil</h1>
        <button class="btn btn-primary"
            onclick="document.getElementById('modalTambah').style.display='block'">
            ➕ Tambah Mobil
        </button>
    </div>

    <!-- READ -->
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID Mobil</th>
                    <th>Jenis</th>
                    <th>Merk</th>
                    <th>Model</th>
                    <th>Tahun</th>
                    <th>Harga/Hari</th>
                    <th>Status</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $q = mysqli_query($conn, "
                SELECT m.*, j.nama_jenis
                FROM master_mobil m
                LEFT JOIN master_jenis_mobil j ON m.id_jenis=j.id_jenis
            ");
            while ($d = mysqli_fetch_assoc($q)) {
            ?>
            <tr>
                <td><?= $d['id_mobil'] ?></td>
                <td><?= $d['nama_jenis'] ?></td>
                <td><?= $d['merk'] ?></td>
                <td><?= $d['model'] ?></td>
                <td><?= $d['tahun'] ?></td>
                <td>Rp <?= number_format($d['harga_sewa_per_hari'],0,',','.') ?></td>
                <td><?= ucfirst($d['status']) ?></td>
                <td style="text-align:center;">
                    <a href="?lihat=<?= $d['id_mobil'] ?>" class="btn btn-info">👁️</a>
                    <a href="?edit=<?= $d['id_mobil'] ?>" class="btn btn-warning">✏️</a>
                    <a href="?hapus=<?= $d['id_mobil'] ?>"
                       onclick="return confirm('Hapus mobil ini?')"
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
        <h3>Tambah Mobil</h3>
        <form method="post">
            <input type="text" name="id_mobil" placeholder="ID Mobil (M016)" required>

            <select name="id_jenis" required>
                <option value="">-- Pilih Jenis Mobil --</option>
                <?php
                $j = mysqli_query($conn, "SELECT * FROM master_jenis_mobil");
                while ($x = mysqli_fetch_assoc($j)) {
                    echo "<option value='$x[id_jenis]'>$x[nama_jenis]</option>";
                }
                ?>
            </select>

            <input type="text" name="merk" placeholder="Merk" required>
            <input type="text" name="model" placeholder="Model" required>
            <input type="number" name="tahun" placeholder="Tahun" required>
            <input type="number" name="harga" placeholder="Harga per Hari" required>

            <select name="status" required>
                <option value="tersedia">Tersedia</option>
                <option value="disewa">Disewa</option>
                <option value="maintenance">Maintenance</option>
            </select>

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
        <h3>Edit Mobil</h3>
        <form method="post">
            <input type="hidden" name="id_mobil" value="<?= $edit['id_mobil'] ?>">

            <select name="id_jenis" required>
                <?php
                $j = mysqli_query($conn, "SELECT * FROM master_jenis_mobil");
                while ($x = mysqli_fetch_assoc($j)) {
                    $sel = $x['id_jenis']==$edit['id_jenis'] ? "selected" : "";
                    echo "<option value='$x[id_jenis]' $sel>$x[nama_jenis]</option>";
                }
                ?>
            </select>

            <input type="text" name="merk" value="<?= $edit['merk'] ?>" required>
            <input type="text" name="model" value="<?= $edit['model'] ?>" required>
            <input type="number" name="tahun" value="<?= $edit['tahun'] ?>" required>
            <input type="number" name="harga"
                   value="<?= $edit['harga_sewa_per_hari'] ?>" required>

            <select name="status">
                <option value="tersedia" <?= $edit['status']=='tersedia'?'selected':'' ?>>Tersedia</option>
                <option value="disewa" <?= $edit['status']=='disewa'?'selected':'' ?>>Disewa</option>
                <option value="maintenance" <?= $edit['status']=='maintenance'?'selected':'' ?>>Maintenance</option>
            </select>

            <br><br>
            <button type="submit" name="update" class="btn btn-success">💾 Update</button>
            <button type="button" class="btn btn-secondary"
                onclick="window.location='master_mobil.php'">
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
        <h3>Detail Mobil</h3>

        <p><b>ID Mobil</b><br><?= $detail['id_mobil'] ?></p>
        <p><b>Jenis</b><br><?= $detail['nama_jenis'] ?></p>
        <p><b>Merk</b><br><?= $detail['merk'] ?></p>
        <p><b>Model</b><br><?= $detail['model'] ?></p>
        <p><b>Tahun</b><br><?= $detail['tahun'] ?></p>
        <p><b>Harga / Hari</b><br>
            Rp <?= number_format($detail['harga_sewa_per_hari'],0,',','.') ?>
        </p>
        <p><b>Status</b><br><?= ucfirst($detail['status']) ?></p>

        <br>
        <button class="btn btn-secondary"
            onclick="window.location='master_mobil.php'">
            Tutup
        </button>
    </div>
</div>
<?php } ?>

</body>
</html>
