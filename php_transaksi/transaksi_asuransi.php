<?php
include "../koneksi.php";

/* =====================
   CREATE / UPDATE
===================== */
if (isset($_POST['simpan'])) {

    // ambil biaya harian asuransi
    $as = mysqli_fetch_assoc(mysqli_query($conn,
        "SELECT biaya_harian FROM master_asuransi 
         WHERE id_asuransi='$_POST[id_asuransi]'"
    ));

    // ambil jumlah hari dari transaksi sewa
    $tr = mysqli_fetch_assoc(mysqli_query($conn,
        "SELECT jumlah_hari FROM transaksi_sewa_mobil 
         WHERE id_transaksi='$_POST[id_transaksi]'"
    ));

    $total = $as['biaya_harian'] * $tr['jumlah_hari'];

    if (isset($_POST['mode']) && $_POST['mode'] == "edit") {
        mysqli_query($conn, "
            UPDATE transaksi_asuransi SET
                id_transaksi='$_POST[id_transaksi]',
                id_asuransi='$_POST[id_asuransi]',
                total_biaya_asuransi='$total'
            WHERE id_trans_asuransi='$_POST[id_trans_asuransi]'
        ");
    } else {
        mysqli_query($conn, "
            INSERT INTO transaksi_asuransi
            (id_trans_asuransi, id_transaksi, id_asuransi, total_biaya_asuransi)
            VALUES (
                '$_POST[id_trans_asuransi]',
                '$_POST[id_transaksi]',
                '$_POST[id_asuransi]',
                '$total'
            )
        ");
    }

    header("Location: transaksi_asuransi.php");
}

/* =====================
   DELETE
===================== */
if (isset($_GET['hapus'])) {
    mysqli_query($conn, "
        DELETE FROM transaksi_asuransi 
        WHERE id_trans_asuransi='$_GET[hapus]'
    ");
    header("Location: transaksi_asuransi.php");
}

/* =====================
   READ (DETAIL)
===================== */
$lihat = null;
if (isset($_GET['lihat'])) {
    $lihat = mysqli_fetch_assoc(mysqli_query($conn, "
        SELECT 
            ta.id_trans_asuransi,
            ta.id_transaksi,
            a.nama_asuransi,
            t.jumlah_hari,
            ta.total_biaya_asuransi
        FROM transaksi_asuransi ta
        JOIN transaksi_sewa_mobil t 
            ON ta.id_transaksi=t.id_transaksi
        JOIN master_asuransi a 
            ON ta.id_asuransi=a.id_asuransi
        WHERE ta.id_trans_asuransi='$_GET[lihat]'
    "));
}

/* =====================
   EDIT
===================== */
$edit = null;
if (isset($_GET['edit'])) {
    $edit = mysqli_fetch_assoc(mysqli_query($conn, "
        SELECT * FROM transaksi_asuransi
        WHERE id_trans_asuransi='$_GET[edit]'
    "));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi Asuransi</title>
    <link rel="stylesheet" href="../css_transaksi/transaksi_asuransi.css">
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
        <a href="transaksi_asuransi.php" class="menu-item active">🛡️ Asuransi</a>
    </div>
</div>

<div class="main-content">
    <div class="top-bar">
        <h1>Transaksi Asuransi</h1>
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
                    <th>ID Transaksi</th>
                    <th>Asuransi</th>
                    <th>Jumlah Hari</th>
                    <th>Total Biaya</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $q = mysqli_query($conn, "
                SELECT 
                    ta.id_trans_asuransi,
                    ta.id_transaksi,
                    a.nama_asuransi,
                    t.jumlah_hari,
                    ta.total_biaya_asuransi
                FROM transaksi_asuransi ta
                JOIN transaksi_sewa_mobil t 
                    ON ta.id_transaksi=t.id_transaksi
                JOIN master_asuransi a 
                    ON ta.id_asuransi=a.id_asuransi
            ");
            while ($d = mysqli_fetch_assoc($q)) {
            ?>
            <tr>
                <td><?= $d['id_trans_asuransi'] ?></td>
                <td><?= $d['id_transaksi'] ?></td>
                <td><?= $d['nama_asuransi'] ?></td>
                <td><?= $d['jumlah_hari'] ?> hari</td>
                <td>Rp <?= number_format($d['total_biaya_asuransi'],0,',','.') ?></td>
                <td style="text-align:center;">
                    <a href="?lihat=<?= $d['id_trans_asuransi'] ?>" class="btn btn-info">👁️</a>
                    <a href="?edit=<?= $d['id_trans_asuransi'] ?>" class="btn btn-warning">✏️</a>
                    <a href="?hapus=<?= $d['id_trans_asuransi'] ?>"
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
        <h3><?= $edit ? "Edit" : "Tambah" ?> Transaksi Asuransi</h3>

        <form method="post">
            <input type="hidden" name="mode" value="<?= $edit?'edit':'tambah' ?>">

            <input type="text" name="id_trans_asuransi"
                   value="<?= $edit['id_trans_asuransi'] ?? '' ?>"
                   placeholder="ID (TA051)" <?= $edit?'readonly':'' ?> required>

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

            <select name="id_asuransi" required>
                <option value="">-- Pilih Asuransi --</option>
                <?php
                $as = mysqli_query($conn, "SELECT * FROM master_asuransi");
                while ($a = mysqli_fetch_assoc($as)) {
                    $s = ($edit && $edit['id_asuransi']==$a['id_asuransi'])?'selected':'';
                    echo "<option value='$a[id_asuransi]' $s>$a[nama_asuransi]</option>";
                }
                ?>
            </select>

            <p style="font-size:12px;color:#64748b">
                * Total biaya dihitung otomatis
            </p>

            <br>
            <button type="submit" name="simpan" class="btn btn-success">💾 Simpan</button>
            <button type="button" class="btn btn-secondary"
                onclick="window.location='transaksi_asuransi.php'">Batal</button>
        </form>
    </div>
</div>

<!-- MODAL READ -->
<?php if ($lihat) { ?>
<div class="modal" style="display:block;">
    <div class="modal-content">
        <h3>Detail Transaksi Asuransi</h3>
        <p><b>ID:</b> <?= $lihat['id_trans_asuransi'] ?></p>
        <p><b>ID Transaksi:</b> <?= $lihat['id_transaksi'] ?></p>
        <p><b>Asuransi:</b> <?= $lihat['nama_asuransi'] ?></p>
        <p><b>Jumlah Hari:</b> <?= $lihat['jumlah_hari'] ?> hari</p>
        <p><b>Total Biaya:</b> Rp <?= number_format($lihat['total_biaya_asuransi'],0,',','.') ?></p>

        <br>
        <button class="btn btn-secondary"
            onclick="window.location='transaksi_asuransi.php'">Tutup</button>
    </div>
</div>
<?php } ?>

</body>
</html>
