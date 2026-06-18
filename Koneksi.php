<?php
// Konfigurasi Database
$host     = "localhost";
$username = "root";      // Default XAMPP adalah root
$password = "";          // Default XAMPP adalah kosong
$database = "db_simulasi_pbo_ti-1d_fathir-ihza-mahendra"; // Ubah sesuai nama database kamu

try {
    // Membuat koneksi ke database dengan PDO
    $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
    
    // Mengatur mode error PDO ke Exception untuk mempermudah debugging
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Mengatur default fetch mode menjadi Associative Array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    // Aktifkan baris di bawah ini hanya untuk tes awal, hapus jika sudah berhasil
    // echo "Koneksi database (PDO) berhasil!"; 
    
} catch (PDOException $e) {
    // Jika koneksi gagal, hentikan skrip dan tampilkan pesan error
    die("Koneksi database gagal: " . $e->getMessage());
}
?>