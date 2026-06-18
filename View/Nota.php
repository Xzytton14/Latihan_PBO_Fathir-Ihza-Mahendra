<?php
// file: View/Nota.php

// Gunakan ../ karena kita harus keluar dari folder View untuk mengakses Config dan Models
require_once '../Config/Koneksi.php';
require_once '../Models/Pendaftaran.php';
require_once '../Models/Regular.php';
require_once '../Models/Prestasi.php';
require_once '../Models/Kedinasan.php';

// Ambil ID dari URL yang dikirim oleh index.php
$id_pendaftaran = isset($_GET['id']) ? (int)$_GET['id'] : 0;

try {
    // Ambil data spesifik mahasiswa berdasarkan ID yang dipilih
    $stmt = $pdo->prepare("SELECT * FROM pendaftaran WHERE id_pendaftaran = ?");
    $stmt->execute([$id_pendaftaran]);
    $data = $stmt->fetch();

    if (!$data) {
        die("<h3 style='color:red; text-align:center; font-family:sans-serif; margin-top:50px;'>Data pendaftaran tidak ditemukan!</h3>");
    }

    $pendaftar = null;
    // Ubah string menjadi huruf kecil semua agar aman membandingkan 'reguler' atau 'regular'
    $jalur = strtolower($data['jalur_pendaftaran']);

    switch ($jalur) {
        case 'reguler':
        case 'regular': // Mengakomodasi ejaan 'regular' sesuai request
            $pendaftar = new PendaftaranReguler(
                $data['nama_calon'], $data['asal_sekolah'], (float)$data['nilai_ujian'], (float)$data['biaya_pendaftaran_dasar'],
                $data['pilihan_prodi'], $data['lokasi_kampus']
            );
            break;
        case 'prestasi':
            $pendaftar = new PendaftaranPrestasi(
                $data['nama_calon'], $data['asal_sekolah'], (float)$data['nilai_ujian'], (float)$data['biaya_pendaftaran_dasar'],
                $data['jenis_prestasi'], $data['tingkat_prestasi']
            );
            break;
        case 'kedinasan':
            $pendaftar = new PendaftaranKedinasan(
                $data['nama_calon'], $data['asal_sekolah'], (float)$data['nilai_ujian'], (float)$data['biaya_pendaftaran_dasar'],
                $data['sk_ikatan_dinas'], $data['instansi_sponsor']
            );
            break;
        default:
            die("<h3 style='color:red; text-align:center;'>Jalur pendaftaran tidak valid!</h3>");
    }
    
    // Pasang ID pendaftaran ke objek
    $pendaftar->setIdPendaftaran((int)$data['id_pendaftaran']);

} catch (PDOException $e) {
    die("Error database: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Hasil Pendaftaran - #<?php echo $pendaftar->getIdPendaftaran(); ?></title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; background-color: #f4f4f4; padding: 20px; }
        .nota-box { max-width: 500px; margin: 0 auto; background: #fff; padding: 30px; border: 1px solid #ddd; box-shadow: 0 4px 8px rgba(0,0,0,0.05); }
        .header { text-align: center; border-bottom: 2px dashed #333; padding-bottom: 15px; margin-bottom: 20px; }
        .header h2 { margin: 5px 0; font-size: 22px; }
        .header p { margin: 0; font-size: 13px; color: #666; }
        .row-info { display: flex; justify-content: space-between; margin: 8px 0; font-size: 14px; }
        .label { color: #555; }
        .value { font-weight: bold; text-align: right; }
        .section-jalur { background-color: #f9f9f9; border-left: 3px solid #333; padding: 10px 15px; margin: 20px 0; font-size: 13px; line-height: 1.6; }
        .footer-nota { margin-top: 25px; border-top: 2px dashed #333; padding-top: 15px; }
        .total-bayar { display: flex; justify-content: space-between; font-size: 18px; font-weight: bold; color: #000; }
        .btn-aksi { display: flex; gap: 10px; margin-top: 30px; }
        .button { flex: 1; text-align: center; padding: 10px; font-weight: bold; font-size: 14px; border-radius: 3px; text-decoration: none; cursor: pointer; }
        .btn-print { background-color: #333; color: #fff; border: none; font-family: inherit; }
        .btn-back { background-color: #e0e0e0; color: #333; }
        @media print {
            .btn-aksi { display: none; }
            body { background: none; padding: 0; }
            .nota-box { box-shadow: none; border: none; }
        }
    </style>
</head>
<body>

<div class="nota-box">
    <div class="header">
        <h2>UNIVERSITAS TEKNIK</h2>
        <p>Nota Bukti Pendaftaran Mahasiswa Baru</p>
        <p>Tanggal Cetak: <?php echo date('d-m-Y H:i'); ?></p>
    </div>

    <div class="row-info">
        <span class="label">No. Pendaftaran</span>
        <span class="value">#<?php echo str_pad($pendaftar->getIdPendaftaran(), 5, "0", STR_PAD_LEFT); ?></span>
    </div>
    <div class="row-info">
        <span class="label">Nama Calon</span>
        <span class="value"><?php echo htmlspecialchars($pendaftar->getNamaCalon()); ?></span>
    </div>
    <div class="row-info">
        <span class="label">Asal Sekolah</span>
        <span class="value"><?php echo htmlspecialchars($pendaftar->getAsalSekolah()); ?></span>
    </div>
    <div class="row-info">
        <span class="label">Nilai Ujian</span>
        <span class="value"><?php echo number_format($pendaftar->getNilaiUjian(), 2); ?></span>
    </div>
    <div class="row-info">
        <span class="label">Biaya Pendaftaran Dasar</span>
        <span class="value">Rp <?php echo number_format($pendaftar->getBiayaPendaftaranDasar(), 0, ',', '.'); ?></span>
    </div>

    <div class="section-jalur">
        <?php $pendaftar->tampilkanInfoJalur(); ?>
    </div>

    <div class="footer-nota">
        <div class="total-bayar">
            <span>TOTAL BIAYA:</span>
            <span>Rp <?php echo number_format($pendaftar->hitungTotalBiaya(), 0, ',', '.'); ?></span>
        </div>
    </div>

    <div class="btn-aksi">
        <a href="../index.php" class="button btn-back"><- Kembali</a>
        <button class="button btn-print" onclick="window.print();">CETAK NOTA</button>
    </div>
</div>

</body>
</html>