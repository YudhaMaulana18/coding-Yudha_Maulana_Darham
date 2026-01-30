<?php
include "../koneksi.php";

/* =====================
   CREATE / UPDATE
===================== */
if (isset($_POST['simpan'])) {

    if ($_POST['mode'] == "edit") {
        mysqli_query($conn, "
            UPDATE transaksi_sewa_sopir SET
                id_sopir='$_POST[id_sopir]',
                id_transaksi='$_POST[id_transaksi]',
                jumlah_hari='$_POST[jumlah_hari]',
                total_tarif='$_POST[total_tarif]'
            WHERE id_sewa_sopir='$_POST[id_sewa_sopir]'
        ");
    } else {
        mysqli_query($conn, "
            INSERT INTO transaksi_sewa_sopir VALUES (
                '$_POST[id_sewa_sopir]',
                '$_POST[id_sopir]',
                '$_POST[id_transaksi]',
                '$_POST[jumlah_hari]',
                '$_POST[total_tarif]'
            )
        ");
    }

    header("Location: transaksi_sewa_sopir.php");
}

/* =====================
   DELETE
===================== */
if (isset($_GET['hapus'])) {
    mysqli_query($conn, "
        DELETE FROM transaksi_sewa_sopir
        WHERE id_sewa_sopir='$_GET[hapus]'
    ");
    header("Location: transaksi_sewa_sopir.php");
}

/* =====================
   READ DETAIL
===================== */
$lihat = null;
if (isset($_GET['lihat'])) {
    $lihat = mysqli_fetch_assoc(mysqli_query($conn, "
        SELECT ss.*, s.nama_sopir
        FROM transaksi_sewa_sopir ss
        JOIN master_sopir s ON ss.id_sopir=s.id_sopir
        WHERE ss.id_sewa_sopir='$_GET[lihat]'
    "));
}

/* =====================
   EDIT
===================== */
$edit = null;
if (isset($_GET['edit'])) {
    $edit = mysqli_fetch_assoc(mysqli_query($conn, "
        SELECT * FROM transaksi_sewa_sopir
        WHERE id_sewa_sopir='$_GET[edit]'
    "));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi Sewa Sopir</title>
    <link rel="stylesheet" href="../css_transaksi/transaksi_sewasopir.css">
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">
        <h2>🚗 RENTAL MOBIL</h2>
        <p>Sistem Manajemen</p>
    </div>
    <a href="../dasbor/jasa sewa.php" class="menu-item">📊 Dashboard</a>
    <div class="menu-section">
        <div class="menu-title">TRANSAKSI</div>
        <a href="transaksi_sewa_sopir.php" class="menu-item active">
            👨‍✈️ Transaksi Sewa Sopir
        </a>
    </div>
</div>

<div class="main-content">
    <div class="top-bar">
        <h1>Transaksi Sewa Sopir</h1>
        <button class="btn btn-primary"
            onclick="document.getElementById('modalForm').style.display='block'">
            ➕ Tambah Sewa Sopir
        </button>
    </div>

    <!-- READ TABLE -->
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Sopir</th>
                    <th>ID Transaksi</th>
                    <th>Hari</th>
                    <th>Total Tarif</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $q = mysqli_query($conn, "
                SELECT ss.*, s.nama_sopir
                FROM transaksi_sewa_sopir ss
                JOIN master_sopir s ON ss.id_sopir=s.id_sopir
            ");
            while ($d = mysqli_fetch_assoc($q)) {
            ?>
            <tr>
                <td><?= $d['id_sewa_sopir'] ?></td>
                <td><?= $d['nama_sopir'] ?></td>
                <td><?= $d['id_transaksi'] ?></td>
                <td><?= $d['jumlah_hari'] ?></td>
                <td>Rp <?= number_format($d['total_tarif'],0,',','.') ?></td>
                <td style="text-align:center;">
                    <a href="?lihat=<?= $d['id_sewa_sopir'] ?>" class="btn btn-info">👁️</a>
                    <a href="?edit=<?= $d['id_sewa_sopir'] ?>" class="btn btn-warning">✏️</a>
                    <a href="?hapus=<?= $d['id_sewa_sopir'] ?>"
                       onclick="return confirm('Hapus data ini?')"
                       class="btn btn-danger">🗑️</a>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL CREATE / UPDATE -->
<div class="modal" id="modalForm" style="<?= $edit?'display:block':'display:none' ?>">
<div class="modal-content">
<h3><?= $edit?'Edit':'Tambah' ?> Sewa Sopir</h3>

<form method="post">
<input type="hidden" name="mode" value="<?= $edit?'edit':'tambah' ?>">

<input type="text" name="id_sewa_sopir"
value="<?= $edit['id_sewa_sopir'] ?? '' ?>"
<?= $edit?'readonly':'' ?>
placeholder="ID Sewa Sopir (SS051)" required>

<select name="id_sopir" required>
<option value="">-- Pilih Sopir --</option>
<?php
$s = mysqli_query($conn,"SELECT * FROM master_sopir");
while($r=mysqli_fetch_assoc($s)){
$sel = ($edit && $edit['id_sopir']==$r['id_sopir'])?'selected':'';
echo "<option value='$r[id_sopir]' $sel>$r[nama_sopir]</option>";
}
?>
</select>

<select name="id_transaksi" required>
<option value="">-- Pilih Transaksi --</option>
<?php
$t = mysqli_query($conn,"SELECT * FROM transaksi_sewa_mobil");
while($r=mysqli_fetch_assoc($t)){
$sel = ($edit && $edit['id_transaksi']==$r['id_transaksi'])?'selected':'';
echo "<option value='$r[id_transaksi]' $sel>$r[id_transaksi]</option>";
}
?>
</select>

<input type="number" name="jumlah_hari"
value="<?= $edit['jumlah_hari'] ?? '' ?>"
placeholder="Jumlah Hari" required>

<input type="number" name="total_tarif"
value="<?= $edit['total_tarif'] ?? '' ?>"
placeholder="Total Tarif" required>

<br><br>
<button type="submit" name="simpan" class="btn btn-success">💾 Simpan</button>
<button type="button" class="btn btn-secondary"
onclick="window.location='transaksi_sewa_sopir.php'">Batal</button>
</form>
</div>
</div>

<!-- MODAL READ -->
<?php if ($lihat) { ?>
<div class="modal" style="display:block;">
<div class="modal-content">
<h3>Detail Sewa Sopir</h3>

<p><b>ID Sewa Sopir:</b> <?= $lihat['id_sewa_sopir'] ?></p>
<p><b>Nama Sopir:</b> <?= $lihat['nama_sopir'] ?></p>
<p><b>ID Transaksi:</b> <?= $lihat['id_transaksi'] ?></p>
<p><b>Jumlah Hari:</b> <?= $lihat['jumlah_hari'] ?></p>
<p><b>Total Tarif:</b> Rp <?= number_format($lihat['total_tarif'],0,',','.') ?></p>

<br>
<button class="btn btn-secondary"
onclick="window.location='transaksi_sewa_sopir.php'">Tutup</button>
</div>
</div>
<?php } ?>

</body>
</html>
