<?php
include "../koneksi.php";

/* =====================
   CREATE
===================== */
if (isset($_POST['simpan'])) {
    mysqli_query($conn, "INSERT INTO master_sopir VALUES (
        '$_POST[id_sopir]',
        '$_POST[nama_sopir]',
        '$_POST[no_hp]',
        '$_POST[sim]',
        '$_POST[tarif_harian]'
    )");
    header("Location: master_sopir.php");
}

/* =====================
   UPDATE
===================== */
if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE master_sopir SET
        nama_sopir='$_POST[nama_sopir]',
        no_hp='$_POST[no_hp]',
        sim='$_POST[sim]',
        tarif_harian='$_POST[tarif_harian]'
        WHERE id_sopir='$_POST[id_sopir]'
    ");
    header("Location: master_sopir.php");
}

/* =====================
   DELETE
===================== */
if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM master_sopir
        WHERE id_sopir='$_GET[hapus]'");
    header("Location: master_sopir.php");
}

/* =====================
   READ DETAIL
===================== */
$detail = false;
if (isset($_GET['lihat'])) {
    $detail = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM master_sopir
            WHERE id_sopir='$_GET[lihat]'")
    );
}

/* =====================
   DATA EDIT
===================== */
$edit = false;
if (isset($_GET['edit'])) {
    $edit = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM master_sopir
            WHERE id_sopir='$_GET[edit]'")
    );
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Master Sopir</title>
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
        <a href="master_sopir.php" class="menu-item active">👨‍✈️ Sopir</a>
    </div>
</div>

<div class="main-content">
    <div class="top-bar">
        <h1>Master Sopir</h1>
        <button class="btn btn-primary"
            onclick="document.getElementById('modalTambah').style.display='block'">
            ➕ Tambah Sopir
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
                    <th>SIM</th>
                    <th>Tarif/Hari</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $q = mysqli_query($conn, "SELECT * FROM master_sopir");
            while ($d = mysqli_fetch_assoc($q)) {
            ?>
            <tr>
                <td><?= $d['id_sopir'] ?></td>
                <td><?= $d['nama_sopir'] ?></td>
                <td><?= $d['no_hp'] ?></td>
                <td><?= $d['sim'] ?></td>
                <td>Rp <?= number_format($d['tarif_harian'],0,',','.') ?></td>
                <td style="text-align:center;">
                    <a href="?lihat=<?= $d['id_sopir'] ?>" class="btn btn-info">👁️</a>
                    <a href="?edit=<?= $d['id_sopir'] ?>" class="btn btn-warning">✏️</a>
                    <a href="?hapus=<?= $d['id_sopir'] ?>"
                       onclick="return confirm('Hapus sopir ini?')"
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
        <h3>Tambah Sopir</h3>
        <form method="post">
            <input type="text" name="id_sopir" placeholder="ID Sopir (S016)" required>
            <input type="text" name="nama_sopir" placeholder="Nama Sopir" required>
            <input type="text" name="no_hp" placeholder="No HP" required>

            <select name="sim" required>
                <option value="">-- Pilih SIM --</option>
                <option value="SIM A">SIM A</option>
                <option value="SIM A Umum">SIM A Umum</option>
                <option value="SIM B1">SIM B1</option>
                <option value="SIM B1 Umum">SIM B1 Umum</option>
                <option value="SIM B2">SIM B2</option>
                <option value="SIM B2 Umum">SIM B2 Umum</option>
            </select>

            <input type="number" name="tarif_harian" placeholder="Tarif Harian" required>

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
        <h3>Edit Sopir</h3>
        <form method="post">
            <input type="hidden" name="id_sopir" value="<?= $edit['id_sopir'] ?>">
            <input type="text" name="nama_sopir" value="<?= $edit['nama_sopir'] ?>" required>
            <input type="text" name="no_hp" value="<?= $edit['no_hp'] ?>" required>

            <select name="sim" required>
                <option value="<?= $edit['sim'] ?>"><?= $edit['sim'] ?></option>
                <option value="SIM A">SIM A</option>
                <option value="SIM A Umum">SIM A Umum</option>
                <option value="SIM B1">SIM B1</option>
                <option value="SIM B1 Umum">SIM B1 Umum</option>
                <option value="SIM B2">SIM B2</option>
                <option value="SIM B2 Umum">SIM B2 Umum</option>
            </select>

            <input type="number" name="tarif_harian" value="<?= $edit['tarif_harian'] ?>" required>

            <br><br>
            <button type="submit" name="update" class="btn btn-success">💾 Update</button>
            <button type="button" class="btn btn-secondary"
                onclick="window.location='master_sopir.php'">
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
        <h3>Detail Sopir</h3>

        <p><b>ID Sopir</b><br><?= $detail['id_sopir'] ?></p>
        <p><b>Nama</b><br><?= $detail['nama_sopir'] ?></p>
        <p><b>No HP</b><br><?= $detail['no_hp'] ?></p>
        <p><b>SIM</b><br><?= $detail['sim'] ?></p>
        <p><b>Tarif Harian</b><br>Rp <?= number_format($detail['tarif_harian'],0,',','.') ?></p>

        <br>
        <button class="btn btn-secondary"
            onclick="window.location='master_sopir.php'">
            Tutup
        </button>
    </div>
</div>
<?php } ?>

</body>
</html>
