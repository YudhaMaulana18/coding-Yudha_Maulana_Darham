<?php
include "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi Sewa Mobil</title>
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
        <div class="menu-title">LAPORAN</div>
        <a href="laporan_sewa_mobil.php" class="menu-item active">
            📄 Laporan Sewa Mobil
        </a>
        <a href="laporan_asuransi.php" class="menu-item">
            🛡️ Laporan Asuransi
        </a>
    </div>
</div>

<div class="main-content">
    <div class="top-bar">
        <h1>Laporan Transaksi Sewa Mobil</h1>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Pelanggan</th>
                    <th>Mobil</th>
                    <th>Lokasi</th>
                    <th>Promo</th>
                    <th>Tanggal Sewa</th>
                    <th>Jumlah Hari</th>
                    <th>Total Biaya</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $q = mysqli_query($conn, "
                SELECT 
                    t.id_transaksi,
                    p.nama_pelanggan,
                    CONCAT(m.merk,' ',m.model) AS mobil,
                    l.nama_lokasi,
                    pr.nama_promo,
                    t.tgl_mulai,
                    t.tgl_selesai,
                    t.jumlah_hari,
                    t.total_biaya,
                    t.status
                FROM transaksi_sewa_mobil t
                JOIN master_pelanggan p 
                    ON t.id_pelanggan = p.id_pelanggan
                JOIN master_mobil m 
                    ON t.id_mobil = m.id_mobil
                JOIN master_lokasi_pengambilan l 
                    ON t.id_lokasi_pengambilan = l.id_lokasi
                LEFT JOIN master_promo pr 
                    ON t.id_promo = pr.id_promo
                ORDER BY t.tgl_mulai DESC
            ");

            while ($d = mysqli_fetch_assoc($q)) {
            ?>
                <tr>
                    <td><?= $d['id_transaksi'] ?></td>
                    <td><?= $d['nama_pelanggan'] ?></td>
                    <td><?= $d['mobil'] ?></td>
                    <td><?= $d['nama_lokasi'] ?></td>
                    <td><?= $d['nama_promo'] ?? '-' ?></td>
                    <td>
                        <?= date('d-m-Y', strtotime($d['tgl_mulai'])) ?>
                        s/d
                        <?= date('d-m-Y', strtotime($d['tgl_selesai'])) ?>
                    </td>
                    <td><?= $d['jumlah_hari'] ?> hari</td>
                    <td>Rp <?= number_format($d['total_biaya'],0,',','.') ?></td>
                    <td><?= ucfirst($d['status']) ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
