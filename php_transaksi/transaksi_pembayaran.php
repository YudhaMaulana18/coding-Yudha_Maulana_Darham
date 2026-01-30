<?php
include "../koneksi.php";

/* =====================
   CREATE / UPDATE
===================== */
if (isset($_POST['simpan'])) {

    if (isset($_POST['mode']) && $_POST['mode'] == "edit") {
        mysqli_query($conn, "
            UPDATE transaksi_pembayaran SET
                id_transaksi='$_POST[id_transaksi]',
                id_metode='$_POST[id_metode]',
                jumlah='$_POST[jumlah]',
                tanggal='$_POST[tanggal]',
                status_pembayaran='$_POST[status]'
            WHERE id_bayar='$_POST[id_bayar]'
        ");
    } else {
        mysqli_query($conn, "
            INSERT INTO transaksi_pembayaran
            (id_bayar, id_transaksi, id_metode, jumlah, tanggal, status_pembayaran)
            VALUES (
                '$_POST[id_bayar]',
                '$_POST[id_transaksi]',
                '$_POST[id_metode]',
                '$_POST[jumlah]',
                '$_POST[tanggal]',
                '$_POST[status]'
            )
        ");
    }

    header("Location: transaksi_pembayaran.php");
}

/* =====================
   DELETE
===================== */
if (isset($_GET['hapus'])) {
    mysqli_query($conn, "
        DELETE FROM transaksi_pembayaran 
        WHERE id_bayar='$_GET[hapus]'
    ");
    header("Location: transaksi_pembayaran.php");
}

/* =====================
   READ (DETAIL)
===================== */
$lihat = null;
if (isset($_GET['lihat'])) {
    $lihat = mysqli_fetch_assoc(mysqli_query($conn, "
        SELECT 
            p.*,
            m.nama_metode
        FROM transaksi_pembayaran p
        JOIN master_metode_pembayaran m
            ON p.id_metode = m.id_metode
        WHERE p.id_bayar='$_GET[lihat]'
    "));
}

/* =====================
   EDIT
===================== */
$edit = null;
if (isset($_GET['edit'])) {
    $edit = mysqli_fetch_assoc(mysqli_query($conn, "
        SELECT * FROM transaksi_pembayaran
        WHERE id_bayar='$_GET[edit]'
    "));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi Pembayaran</title>
    <link rel="stylesheet" href="../css_transaksi/transaksi_pembayaran.css">
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
        <a href="transaksi_pembayaran.php" class="menu-item active">💰 Pembayaran</a>
    </div>
</div>

<div class="main-content">
    <div class="top-bar">
        <h1>Transaksi Pembayaran</h1>
        <button class="btn btn-primary"
            onclick="document.getElementById('modalForm').style.display='block'">
            ➕ Tambah Pembayaran
        </button>
    </div>

    <!-- READ TABLE -->
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID Bayar</th>
                    <th>ID Transaksi</th>
                    <th>Metode</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $q = mysqli_query($conn, "
                SELECT p.*, m.nama_metode
                FROM transaksi_pembayaran p
                JOIN master_metode_pembayaran m
                    ON p.id_metode = m.id_metode
            ");
            while ($d = mysqli_fetch_assoc($q)) {
            ?>
            <tr>
                <td><?= $d['id_bayar'] ?></td>
                <td><?= $d['id_transaksi'] ?></td>
                <td><?= $d['nama_metode'] ?></td>
                <td>Rp <?= number_format($d['jumlah'],0,',','.') ?></td>
                <td><?= $d['tanggal'] ?></td>
                <td><?= ucfirst($d['status_pembayaran']) ?></td>
                <td style="text-align:center;">
                    <a href="?lihat=<?= $d['id_bayar'] ?>" class="btn btn-info">👁️</a>
                    <a href="?edit=<?= $d['id_bayar'] ?>" class="btn btn-warning">✏️</a>
                    <a href="?hapus=<?= $d['id_bayar'] ?>"
                       onclick="return confirm('Hapus pembayaran ini?')"
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
        <h3><?= $edit?'Edit':'Tambah' ?> Pembayaran</h3>

        <form method="post">
            <input type="hidden" name="mode" value="<?= $edit?'edit':'tambah' ?>">

            <input type="text" name="id_bayar"
                   value="<?= $edit['id_bayar'] ?? '' ?>"
                   placeholder="ID Bayar (B051)" <?= $edit?'readonly':'' ?> required>

            <select name="id_transaksi" required>
                <option value="">-- Pilih Transaksi --</option>
                <?php
                $trx = mysqli_query($conn, "SELECT id_transaksi FROM transaksi_sewa_mobil");
                while ($t = mysqli_fetch_assoc($trx)) {
                    $s = ($edit && $edit['id_transaksi']==$t['id_transaksi'])?'selected':'';
                    echo "<option value='$t[id_transaksi]' $s>$t[id_transaksi]</option>";
                }
                ?>
            </select>

            <select name="id_metode" required>
                <option value="">-- Pilih Metode --</option>
                <?php
                $m = mysqli_query($conn, "SELECT * FROM master_metode_pembayaran");
                while ($metode = mysqli_fetch_assoc($m)) {
                    $s = ($edit && $edit['id_metode']==$metode['id_metode'])?'selected':'';
                    echo "<option value='$metode[id_metode]' $s>$metode[nama_metode]</option>";
                }
                ?>
            </select>

            <input type="number" name="jumlah"
                   value="<?= $edit['jumlah'] ?? '' ?>"
                   placeholder="Jumlah Pembayaran" required>

            <input type="date" name="tanggal"
                   value="<?= $edit['tanggal'] ?? '' ?>" required>

            <select name="status" required>
                <option value="">-- Status --</option>
                <option value="lunas"   <?= ($edit && $edit['status_pembayaran']=='lunas')?'selected':'' ?>>Lunas</option>
                <option value="pending" <?= ($edit && $edit['status_pembayaran']=='pending')?'selected':'' ?>>Pending</option>
                <option value="batal"   <?= ($edit && $edit['status_pembayaran']=='batal')?'selected':'' ?>>Batal</option>
            </select>

            <br><br>
            <button type="submit" name="simpan" class="btn btn-success">💾 Simpan</button>
            <button type="button" class="btn btn-secondary"
                onclick="window.location='transaksi_pembayaran.php'">Batal</button>
        </form>
    </div>
</div>

<!-- MODAL READ -->
<?php if ($lihat) { ?>
<div class="modal" style="display:block;">
    <div class="modal-content">
        <h3>Detail Pembayaran</h3>
        <p><b>ID Bayar:</b> <?= $lihat['id_bayar'] ?></p>
        <p><b>ID Transaksi:</b> <?= $lihat['id_transaksi'] ?></p>
        <p><b>Metode:</b> <?= $lihat['nama_metode'] ?></p>
        <p><b>Jumlah:</b> Rp <?= number_format($lihat['jumlah'],0,',','.') ?></p>
        <p><b>Tanggal:</b> <?= $lihat['tanggal'] ?></p>
        <p><b>Status:</b> <?= ucfirst($lihat['status_pembayaran']) ?></p>

        <br>
        <button class="btn btn-secondary"
            onclick="window.location='transaksi_pembayaran.php'">Tutup</button>
    </div>
</div>
<?php } ?>

</body>
</html>
