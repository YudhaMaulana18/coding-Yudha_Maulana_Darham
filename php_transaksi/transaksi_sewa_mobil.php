<?php
include "../koneksi.php";

/* =====================
   CREATE / UPDATE
===================== */
if (isset($_POST['simpan'])) {

    if ($_POST['mode'] == "edit") {
        mysqli_query($conn, "
            UPDATE transaksi_sewa_mobil SET
                id_pelanggan='$_POST[id_pelanggan]',
                id_mobil='$_POST[id_mobil]',
                id_lokasi_pengambilan='$_POST[id_lokasi]',
                id_promo=".($_POST['id_promo'] ? "'$_POST[id_promo]'" : "NULL").",
                tgl_mulai='$_POST[tgl_mulai]',
                tgl_selesai='$_POST[tgl_selesai]',
                jumlah_hari='$_POST[jumlah_hari]',
                total_biaya='$_POST[total_biaya]',
                status='$_POST[status]'
            WHERE id_transaksi='$_POST[id_transaksi]'
        ");
    } else {
        mysqli_query($conn, "
            INSERT INTO transaksi_sewa_mobil
            VALUES (
                '$_POST[id_transaksi]',
                '$_POST[id_pelanggan]',
                '$_POST[id_mobil]',
                '$_POST[id_lokasi]',
                ".($_POST['id_promo'] ? "'$_POST[id_promo]'" : "NULL").",
                '$_POST[tgl_mulai]',
                '$_POST[tgl_selesai]',
                '$_POST[jumlah_hari]',
                '$_POST[total_biaya]',
                '$_POST[status]'
            )
        ");

        // update status mobil
        mysqli_query($conn, "
            UPDATE master_mobil 
            SET status='disewa'
            WHERE id_mobil='$_POST[id_mobil]'
        ");
    }

    header("Location: transaksi_sewa_mobil.php");
}

/* =====================
   DELETE
===================== */
if (isset($_GET['hapus'])) {
    mysqli_query($conn, "
        DELETE FROM transaksi_sewa_mobil
        WHERE id_transaksi='$_GET[hapus]'
    ");
    header("Location: transaksi_sewa_mobil.php");
}

/* =====================
   READ DETAIL
===================== */
$lihat = null;
if (isset($_GET['lihat'])) {
    $lihat = mysqli_fetch_assoc(mysqli_query($conn, "
        SELECT *
        FROM transaksi_sewa_mobil
        WHERE id_transaksi='$_GET[lihat]'
    "));
}

/* =====================
   EDIT
===================== */
$edit = null;
if (isset($_GET['edit'])) {
    $edit = mysqli_fetch_assoc(mysqli_query($conn, "
        SELECT *
        FROM transaksi_sewa_mobil
        WHERE id_transaksi='$_GET[edit]'
    "));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi Sewa Mobil</title>
    <link rel="stylesheet" href="../css_transaksi/transaksi_sewamobil.css">
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
        <a href="transaksi_sewa_mobil.php" class="menu-item active">
            🚗 Transaksi Sewa Mobil
        </a>
    </div>
</div>

<div class="main-content">
    <div class="top-bar">
        <h1>Transaksi Sewa Mobil</h1>
        <button class="btn btn-primary"
            onclick="document.getElementById('modalForm').style.display='block'">
            ➕ Tambah Transaksi
        </button>
    </div>

    <!-- READ TABLE -->
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Mobil</th>
                    <th>Lokasi</th>
                    <th>Promo</th>
                    <th>Tanggal</th>
                    <th>Hari</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $q = mysqli_query($conn, "
                SELECT t.*, 
                       p.nama_pelanggan,
                       m.merk, m.model,
                       l.nama_lokasi,
                       pr.nama_promo
                FROM transaksi_sewa_mobil t
                JOIN master_pelanggan p ON t.id_pelanggan=p.id_pelanggan
                JOIN master_mobil m ON t.id_mobil=m.id_mobil
                JOIN master_lokasi_pengambilan l 
                    ON t.id_lokasi_pengambilan=l.id_lokasi
                LEFT JOIN master_promo pr ON t.id_promo=pr.id_promo
            ");
            while ($d = mysqli_fetch_assoc($q)) {
            ?>
            <tr>
                <td><?= $d['id_transaksi'] ?></td>
                <td><?= $d['nama_pelanggan'] ?></td>
                <td><?= $d['merk'] ?> <?= $d['model'] ?></td>
                <td><?= $d['nama_lokasi'] ?></td>
                <td><?= $d['nama_promo'] ?? '-' ?></td>
                <td><?= $d['tgl_mulai'] ?> s/d <?= $d['tgl_selesai'] ?></td>
                <td><?= $d['jumlah_hari'] ?></td>
                <td>Rp <?= number_format($d['total_biaya'],0,',','.') ?></td>
                <td><?= ucfirst($d['status']) ?></td>
                <td style="text-align:center;">
                    <a href="?lihat=<?= $d['id_transaksi'] ?>" class="btn btn-info">👁️</a>
                    <a href="?edit=<?= $d['id_transaksi'] ?>" class="btn btn-warning">✏️</a>
                    <a href="?hapus=<?= $d['id_transaksi'] ?>"
                       onclick="return confirm('Hapus transaksi ini?')"
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
<h3><?= $edit?'Edit':'Tambah' ?> Transaksi</h3>

<form method="post">
<input type="hidden" name="mode" value="<?= $edit?'edit':'tambah' ?>">

<input type="text" name="id_transaksi"
value="<?= $edit['id_transaksi'] ?? '' ?>"
<?= $edit?'readonly':'' ?>
placeholder="ID Transaksi (T051)" required>

<select name="id_pelanggan" required>
<option value="">-- Pelanggan --</option>
<?php
$p = mysqli_query($conn,"SELECT * FROM master_pelanggan");
while($r=mysqli_fetch_assoc($p)){
$s=($edit && $edit['id_pelanggan']==$r['id_pelanggan'])?'selected':'';
echo "<option value='$r[id_pelanggan]' $s>$r[nama_pelanggan]</option>";
}
?>
</select>

<select name="id_mobil" required>
<option value="">-- Mobil --</option>
<?php
$m = mysqli_query($conn,"SELECT * FROM master_mobil");
while($r=mysqli_fetch_assoc($m)){
$s=($edit && $edit['id_mobil']==$r['id_mobil'])?'selected':'';
echo "<option value='$r[id_mobil]' $s>$r[merk] $r[model]</option>";
}
?>
</select>

<select name="id_lokasi" required>
<option value="">-- Lokasi --</option>
<?php
$l = mysqli_query($conn,"SELECT * FROM master_lokasi_pengambilan");
while($r=mysqli_fetch_assoc($l)){
$s=($edit && $edit['id_lokasi_pengambilan']==$r['id_lokasi'])?'selected':'';
echo "<option value='$r[id_lokasi]' $s>$r[nama_lokasi]</option>";
}
?>
</select>

<select name="id_promo">
<option value="">-- Tanpa Promo --</option>
<?php
$pr = mysqli_query($conn,"SELECT * FROM master_promo");
while($r=mysqli_fetch_assoc($pr)){
$s=($edit && $edit['id_promo']==$r['id_promo'])?'selected':'';
echo "<option value='$r[id_promo]' $s>$r[nama_promo]</option>";
}
?>
</select>

<input type="date" name="tgl_mulai" value="<?= $edit['tgl_mulai'] ?? '' ?>" required>
<input type="date" name="tgl_selesai" value="<?= $edit['tgl_selesai'] ?? '' ?>" required>
<input type="number" name="jumlah_hari" value="<?= $edit['jumlah_hari'] ?? '' ?>" required>
<input type="number" name="total_biaya" value="<?= $edit['total_biaya'] ?? '' ?>" required>

<select name="status" required>
<option value="">-- Status --</option>
<option value="aktif" <?= ($edit && $edit['status']=='aktif')?'selected':'' ?>>Aktif</option>
<option value="selesai" <?= ($edit && $edit['status']=='selesai')?'selected':'' ?>>Selesai</option>
<option value="batal" <?= ($edit && $edit['status']=='batal')?'selected':'' ?>>Batal</option>
</select>

<br><br>
<button type="submit" name="simpan" class="btn btn-success">💾 Simpan</button>
<button type="button" class="btn btn-secondary"
onclick="window.location='transaksi_sewa_mobil.php'">Batal</button>
</form>
</div>
</div>

<!-- MODAL READ -->
<?php if ($lihat) { ?>
<div class="modal" style="display:block;">
<div class="modal-content">
<h3>Detail Transaksi</h3>
<p><b>ID:</b> <?= $lihat['id_transaksi'] ?></p>
<p><b>Pelanggan:</b> <?= $lihat['id_pelanggan'] ?></p>
<p><b>Mobil:</b> <?= $lihat['id_mobil'] ?></p>
<p><b>Lokasi:</b> <?= $lihat['id_lokasi_pengambilan'] ?></p>
<p><b>Hari:</b> <?= $lihat['jumlah_hari'] ?></p>
<p><b>Total:</b> Rp <?= number_format($lihat['total_biaya'],0,',','.') ?></p>
<p><b>Status:</b> <?= ucfirst($lihat['status']) ?></p>

<br>
<button class="btn btn-secondary"
onclick="window.location='transaksi_sewa_mobil.php'">Tutup</button>
</div>
</div>
<?php } ?>

</body>
</html>
