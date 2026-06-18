<?php
// file: index.php
require_once 'Config/Koneksi.php';

try {
    // Ambil semua data pendaftaran untuk ditampilkan di tabel utama
    $stmt = $pdo->query("SELECT id_pendaftaran, nama_calon, asal_sekolah, jalur_pendaftaran FROM pendaftaran ORDER BY id_pendaftaran DESC");
    $semua_pendaftar = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Gagal mengambil data: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Pendaftaran Mahasiswa Baru</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 30px; color: #333; }
        .container { max-width: 900px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        h2 { text-align: center; margin-bottom: 20px; color: #222; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #333; color: #fff; }
        tr:hover { background-color: #f5f5f5; }
        .badge { padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .badge-reguler { background-color: #e3f2fd; color: #0d47a1; }
        .badge-prestasi { background-color: #e8f5e9; color: #1b5e20; }
        .badge-kedinasan { background-color: #fff3e0; color: #e65100; }
        .btn-cetak { display: inline-block; padding: 6px 12px; background-color: #333; color: #fff; text-decoration: none; border-radius: 4px; font-size: 13px; font-weight: bold; }
        .btn-cetak:hover { background-color: #555; }
    </style>
</head>
<body>

<div class="container">
    <h2>Daftar Calon Mahasiswa Baru</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Calon</th>
                <th>Asal Sekolah</th>
                <th>Jalur Pendaftaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($semua_pendaftar as $row): ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo htmlspecialchars($row['nama_calon']); ?></td>
                <td><?php echo htmlspecialchars($row['asal_sekolah']); ?></td>
                <td>
                    <span class="badge <?php 
                        echo (strtolower($row['jalur_pendaftaran']) == 'reguler' || strtolower($row['jalur_pendaftaran']) == 'regular') ? 'badge-reguler' : 
                             (strtolower($row['jalur_pendaftaran']) == 'prestasi' ? 'badge-prestasi' : 'badge-kedinasan'); 
                    ?>">
                        <?php echo ucfirst($row['jalur_pendaftaran']); ?>
                    </span>
                </td>
                <td>
                    <a href="View/Nota.php?id=<?php echo $row['id_pendaftaran']; ?>" class="btn-cetak" target="_blank">Cetak Nota</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>