<?php

class PendaftaranReguler extends Pendaftaran {
    // Properti Tambahan (camelCase)
    private string $pilihanProdi;
    private string $lokasiKampus;

    public function __construct(
        string $namaCalon, 
        string $asalSekolah, 
        float $nilaiUjian, 
        float $biayaDasar, 
        string $pilihanProdi, 
        string $lokasiKampus
    ) {
        parent::__construct($namaCalon, $asalSekolah, $nilaiUjian, $biayaDasar);
        $this->pilihanProdi = $pilihanProdi;
        $this->lokasiKampus = $lokasiKampus;
    }

    // Getter untuk properti spesifik
    public function getPilihanProdi(): string { return $this->pilihanProdi; }
    public function getLokasiKampus(): string { return $this->lokasiKampus; }

    // Implementasi Method Abstract dari Induk
    public function hitungTotalBiaya(): float {
        return $this->biayaPendaftaranDasar; // Reguler tidak ada tambahan/potongan biaya
    }

    public function tampilkanInfoJalur(): void {
        echo "=== JALUR REGULER ===<br>";
        echo "Prodi: " . $this->pilihanProdi . "<br>";
        echo "Kampus: " . $this->lokasiKampus . "<br>";
    }

    /**
     * Metode Query Spesifik untuk mengambil semua data Reguler
     * @param PDO $db Objek koneksi database PDO
     * @return PendaftaranReguler[] Array berisi objek dari kelas ini
     */
    public static function getDaftarReguler(PDO $db): array {
        $sql = "SELECT id_pendaftaran, nama_calon, asal_sekolah, nilai_ujian, biaya_pendaftaran_dasar, pilihan_prodi, lokasi_kampus 
                FROM pendaftaran 
                WHERE jalur_pendaftaran = 'Reguler'";
        
        $stmt = $db->query($sql);
        $rows = $stmt->fetchAll();
        
        $daftarReguler = [];
        foreach ($rows as $row) {
            // Instansiasi objek dari data database
            $obj = new self(
                $row['nama_calon'],
                $row['asal_sekolah'],
                (float)$row['nilai_ujian'],
                (float)$row['biaya_pendaftaran_dasar'],
                $row['pilihan_prodi'],
                $row['lokasi_kampus']
            );
            $obj->setIdPendaftaran((int)$row['id_pendaftaran']);
            $daftarReguler[] = $obj;
        }
        
        return $daftarReguler;
    }
}