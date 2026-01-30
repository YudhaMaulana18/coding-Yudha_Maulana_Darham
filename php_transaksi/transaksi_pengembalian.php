<?php
include "../koneksi.php";

/* =====================
   CREATE / UPDATE
===================== */
if (isset($_POST['simpan'])) {

    if (isset($_POST['mode']) && $_POST['mode'] == "edit") {
        mysqli_query($conn, "
            UPDATE transaksi_pengembalian SET
                id_transaksi='$_POST[id_transaksi]',
                kondisi_mobil='$_POST[kondisi]',
                biaya_denda='$_POST[biaya_denda]',
                tanggal_kembali='$_POST[tanggal_kembali]',
                catatan='$_POST[catatan]'
            WHERE id_kembali='$_POST[id_kembali]'
        ");
    } else {
        mysqli_query($conn, "
            INSERT INTO transaksi_pengembalian
            (id_kembali, id_transaksi, kondisi_mobil, biaya_denda, tanggal_kembali, catatan)
            VALUES (
                '$_POST[id_kembali]',
                '$_POST[id_transaksi]',
                '$_POST[kondisi]',
                '$_POST[biaya_denda]',
                '$_POST[tanggal_kembali]',
                '$_POST[catatan]'
            )
        ");
    }

    header("Location: transaksi_pengembalian.php");
}

/* =====================
   DELETE
===================== */
if (isset($_GET['hapus'])) {
    mysqli_query($conn, "
        DELETE FROM transaksi_pengembalian
        WHERE id_kembali='$_GET[hapus]'
    ");
    header("Location: transaksi_pengembalian.php");
}

/* =====================
   READ (DETAIL)
===================== */
$lihat = null;
if (isset($_GET['lihat'])) {
    $lihat = mysqli_fetch_assoc(mysqli_query($conn, "
        SELECT *
        FROM transaksi_pengembalian
        WHERE id_kembali='$_GET[lihat]'
    "));
}

/* =====================
   EDIT
===================== */
$edit = null;
if (isset($_GET['edit'])) {
    $edit = mysqli_fetch_assoc(mysqli_query($conn, "
        SELECT *
        FROM transaksi_pengembalian
        WHERE id_kembali='$_GET[edit]'
    "));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi Pengembalian</title>
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
        <a href="transaksi_pengembalian.php" class="menu-item active">
            🔄 Transaksi Pengembalian
        </a>
    </div>
</div>

<div class="main-content">
    <div class="top-bar">
        <h1>Transaksi Pengembalian</h1>
        <button class="btn btn-primary"
            onclick="document.getElementById('modalForm').style.display='block'">
            ➕ Tambah Pengembalian
        </button>
    </div>

    <!-- READ TABLE -->
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID Kembali</th>
                    <th>ID Transaksi</th>
                    <th>Kondisi Mobil</th>
                    <th>Denda</th>
                    <th>Tanggal Kembali</th>
                    <th>Catatan</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $q = mysqli_query($conn, "
                SELECT *
                FROM transaksi_pengembalian
            ");
            while ($d = mysqli_fetch_assoc($q)) {
            ?>
            <tr>
                <td><?= $d['id_kembali'] ?></td>
                <td><?= $d['id_transaksi'] ?></td>
                <td><?= $d['kondisi_mobil'] ?></td>
                <td>Rp <?= number_format($d['biaya_denda'],0,',','.') ?></td>
                <td><?= $d['tanggal_kembali'] ?></td>
                <td><?= $d['catatan'] ?></td>
                <td style="text-align:center;">
                    <a href="?lihat=<?= $d['id_kembali'] ?>" class="btn btn-info">👁️</a>
                    <a href="?edit=<?= $d['id_kembali'] ?>" class="btn btn-warning">✏️</a>
                    <a href="?hapus=<?= $d['id_kembali'] ?>"
                       onclick="return confirm('Hapus data pengembalian ini?')"
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
        <h3><?= $edit?'Edit':'Tambah' ?> Pengembalian</h3>

        <form method="post">
            <input type="hidden" name="mode" value="<?= $edit?'edit':'tambah' ?>">

            <input type="text" name="id_kembali"
                   value="<?= $edit['id_kembali'] ?? '' ?>"
                   placeholder="ID Kembali (R051)"
                   <?= $edit?'readonly':'' ?> required>

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

            <select name="kondisi" required>
                <option value="">-- Kondisi Mobil --</option>
                <option value="Baik" <?= ($edit && $edit['kondisi_mobil']=='Baik')?'selected':'' ?>>Baik</option>
                <option value="Gores kecil" <?= ($edit && $edit['kondisi_mobil']=='Gores kecil')?'selected':'' ?>>Gores Kecil</option>
                <option value="Rusak" <?= ($edit && $edit['kondisi_mobil']=='Rusak')?'selected':'' ?>>Rusak</option>
            </select>

            <input type="number" name="biaya_denda"
                   value="<?= $edit['biaya_denda'] ?? '' ?>"
                   placeholder="Biaya Denda" required>

            <input type="date" name="tanggal_kembali"
                   value="<?= $edit['tanggal_kembali'] ?? '' ?>" required>

            <textarea name="catatan" placeholder="Catatan"><?= $edit['catatan'] ?? '' ?></textarea>

            <br><br>
            <button type="submit" name="simpan" class="btn btn-success">💾 Simpan</button>
            <button type="button" class="btn btn-secondary"
                onclick="window.location='transaksi_pengembalian.php'">
                Batal
            </button>
        </form>
    </div>
</div>

<!-- MODAL READ -->
<?php if ($lihat) { ?>
<div class="modal" style="display:block;">
    <div class="modal-content">
        <h3>Detail Pengembalian</h3>
        <p><b>ID Kembali:</b> <?= $lihat['id_kembali'] ?></p>
        <p><b>ID Transaksi:</b> <?= $lihat['id_transaksi'] ?></p>
        <p><b>Kondisi:</b> <?= $lihat['kondisi_mobil'] ?></p>
        <p><b>Denda:</b> Rp <?= number_format($lihat['biaya_denda'],0,',','.') ?></p>
        <p><b>Tanggal Kembali:</b> <?= $lihat['tanggal_kembali'] ?></p>
        <p><b>Catatan:</b> <?= $lihat['catatan'] ?></p>

        <br>
        <button class="btn btn-secondary"
            onclick="window.location='transaksi_pengembalian.php'">
            Tutup
        </button>
    </div>
</div>
<?php } ?>

</body>
</html>
