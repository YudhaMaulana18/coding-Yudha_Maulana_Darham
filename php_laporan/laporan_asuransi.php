<?php
include "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi Asuransi</title>
    <link rel="stylesheet" href="../css_master/master_SCTV.css">
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-header">
        <h2>🚗 RENTAL MOBIL</h2>
        <p>Sistem Manajemen</p>
    </div>

    <a href="../dasbor/jasa sewa.php" class="menu-item">📊 Dashboard</a>

    <div class="menu-section">
        <div class="menu-title">LAPORAN</div>
        <a href="laporan_sewa_mobil.php" class="menu-item">📄 Laporan Sewa Mobil</a>
        <a href="laporan_asuransi.php" class="menu-item active">🛡️ Laporan Asuransi</a>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="top-bar">
        <h1>Laporan Transaksi Asuransi</h1>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID Trans Asuransi</th>
                    <th>ID Transaksi</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Asuransi</th>
                    <th>Jumlah Hari</th>
                    <th>Total Biaya Asuransi</th>
                </tr>
            </thead>
            <tbody>
            <?php
            /* ======================
               QUERY LAPORAN (JOIN)
               ====================== */
            $q = mysqli_query($conn, "
                SELECT 
                    ta.id_trans_asuransi,
                    ta.id_transaksi,
                    p.nama_pelanggan,
                    a.nama_asuransi,
                    t.jumlah_hari,
                    ta.total_biaya_asuransi
                FROM transaksi_asuransi ta
                JOIN transaksi_sewa_mobil t 
                    ON ta.id_transaksi = t.id_transaksi
                JOIN master_asuransi a 
                    ON ta.id_asuransi = a.id_asuransi
                JOIN master_pelanggan p 
                    ON t.id_pelanggan = p.id_pelanggan
                ORDER BY ta.id_trans_asuransi DESC
            ");

            while ($d = mysqli_fetch_assoc($q)) {
            ?>
                <tr>
                    <td><?= $d['id_trans_asuransi'] ?></td>
                    <td><?= $d['id_transaksi'] ?></td>
                    <td><?= $d['nama_pelanggan'] ?></td>
                    <td><?= $d['nama_asuransi'] ?></td>
                    <td><?= $d['jumlah_hari'] ?> hari</td>
                    <td>
                        Rp <?= number_format($d['total_biaya_asuransi'], 0, ',', '.') ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
