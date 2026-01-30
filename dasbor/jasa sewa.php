<?php
include "../koneksi.php";

/* =======================
   STATISTIK DASHBOARD
======================= */

// Total mobil
$qMobil = mysqli_query($conn, "SELECT COUNT(*) AS total FROM master_mobil");
$totalMobil = mysqli_fetch_assoc($qMobil)['total'];

// Mobil sedang disewa
$qDisewa = mysqli_query($conn, "SELECT COUNT(*) AS total FROM master_mobil WHERE status='disewa'");
$mobilDisewa = mysqli_fetch_assoc($qDisewa)['total'];

// Total pelanggan
$qPelanggan = mysqli_query($conn, "SELECT COUNT(*) AS total FROM master_pelanggan");
$totalPelanggan = mysqli_fetch_assoc($qPelanggan)['total'];

// Pendapatan bulan ini
$qPendapatan = mysqli_query($conn, "
    SELECT SUM(jumlah) AS total 
    FROM transaksi_pembayaran 
    WHERE MONTH(tanggal)=MONTH(CURDATE())
      AND YEAR(tanggal)=YEAR(CURDATE())
");
$pendapatan = mysqli_fetch_assoc($qPendapatan)['total'] ?? 0;

// Transaksi terbaru (JOIN)
$qTransaksi = mysqli_query($conn, "
SELECT 
  t.id_transaksi,
  p.nama_pelanggan,
  CONCAT(m.merk,' ',m.model) AS mobil,
  t.tgl_mulai,
  t.status
FROM transaksi_sewa_mobil t
JOIN master_pelanggan p ON t.id_pelanggan = p.id_pelanggan
JOIN master_mobil m ON t.id_mobil = m.id_mobil
ORDER BY t.tgl_mulai DESC
LIMIT 5
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Jasa Sewa</title>
    <link rel="stylesheet" href="../dasbor/jasa sewa.css">
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">
        <h2>🚗 RENTAL MOBIL</h2>
        <p>Sistem Manajemen</p>
    </div>

    <div class="menu-section">
        <div class="menu-item active">
            <span>📊</span>
            <span>Dashboard</span>
        </div>
    </div>

    <div class="menu-section">
        <div class="menu-title">Master Data</div>
        <div class="menu-item toggle-menu" onclick="toggleSubmenu('masterMenu')">
            <span>📋</span>
            <span>Master Data</span>
            <span class="arrow">▶</span>
        </div>
        <div class="submenu" id="masterMenu">
            <a href="../php_master/master_asuransi.php" class="menu-item">Asuransi</a>
            <a href="../php_master/master_jenis_mobil.php" class="menu-item">Jenis Mobil</a>
            <a href="../php_master/master_lokasi_pengambilan.php" class="menu-item">Lokasi Pengambilan</a>
            <a href="../php_master/master_metode_pembayaran.php" class="menu-item">Metode Pembayaran</a>
            <a href="../php_master/master_pelanggan.php" class="menu-item">Pelanggan</a>
            <a href="../php_master/master_promo.php" class="menu-item">Promo</a>
            <a href="../php_master/master_sopir.php" class="menu-item">Sopir</a>
            <a href="../php_master/master_mobil.php" class="menu-item">Mobil</a>
        </div>
    </div>

    <div class="menu-section">
        <div class="menu-title">Transaksi</div>
        <div class="menu-item toggle-menu" onclick="toggleSubmenu('transaksiMenu')">
            <span>💳</span>
            <span>Transaksi</span>
            <span class="arrow">▶</span>
        </div>
        <div class="submenu" id="transaksiMenu">
            <a href="../php_transaksi/transaksi_sewa_mobil.php" class="menu-item">Sewa Mobil</a>
            <a href="../php_transaksi/transaksi_sewa_sopir.php" class="menu-item">Sewa Sopir</a>
            <a href="../php_transaksi/transaksi_asuransi.php" class="menu-item">Asuransi</a>
            <a href="../php_transaksi/transaksi_pembayaran.php" class="menu-item">Pembayaran</a>
            <a href="../php_transaksi/transaksi_pengembalian.php" class="menu-item">Pengembalian</a>
        </div>
    </div>
    <div class="menu-section">
    <div class="menu-title">Laporan</div>
    <div class="menu-item toggle-menu" onclick="toggleSubmenu('laporanMenu')">
        <span>📑</span>
        <span>Laporan</span>
        <span class="arrow">▶</span>
    </div>
    <div class="submenu" id="laporanMenu">
        <a href="../php_laporan/laporan_sewa_mobil.php" class="menu-item">
            📊 Laporan Sewa Mobil
        </a>
        <a href="../php_laporan/laporan_asuransi.php" class="menu-item">
            🛡️ Laporan Asuransi
        </a>
    </div>
</div>

</div>

<div class="main-content">
    <div class="top-bar">
        <h1>Dashboard</h1>
        <div class="user-info">
            <div>
                <div style="font-weight:600;">Yudha Maulana Darham</div>
                <div style="font-size:12px;">DIREKTUR</div>
            </div>
            <div class="user-avatar">YMD</div>
        </div>
    </div>

    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-value"><?= $totalMobil ?></div>
            <div class="stat-label">Total Mobil</div>
        </div>

        <div class="stat-card">
            <div class="stat-value"><?= $mobilDisewa ?></div>
            <div class="stat-label">Sedang Disewa</div>
        </div>

        <div class="stat-card">
            <div class="stat-value"><?= $totalPelanggan ?></div>
            <div class="stat-label">Total Pelanggan</div>
        </div>

        <div class="stat-card">
            <div class="stat-value">
                Rp <?= number_format($pendapatan,0,',','.') ?>
            </div>
            <div class="stat-label">Pendapatan Bulan Ini</div>
        </div>
    </div>

    <div class="card">
        <h3>Transaksi Terbaru</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Mobil</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php while($d = mysqli_fetch_assoc($qTransaksi)) { ?>
                <tr>
                    <td><?= $d['id_transaksi'] ?></td>
                    <td><?= $d['nama_pelanggan'] ?></td>
                    <td><?= $d['mobil'] ?></td>
                    <td><?= date('d M Y', strtotime($d['tgl_mulai'])) ?></td>
                    <td><?= ucfirst($d['status']) ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../dasbor/jasa sewa.js"></script>
</body>
</html>
