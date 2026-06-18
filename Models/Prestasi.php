<?php

class PendaftaranPrestasi extends Pendaftaran {
    // Properti tambahan (camelCase)
    private string $jenisPrestasi;
    private string $tingkatPrestasi;

    public function __construct(
        string $namaCalon, 
        string $asalSekolah, 
        float $nilaiUjian, 
        float $biayaDasar, 
        string $jenisPrestasi, 
        string $tingkatPrestasi
    ) {
        parent::__construct($namaCalon, $asalSekolah, $nilaiUjian, $biayaDasar);
        $this->jenisPrestasi = $jenisPrestasi;
        $this->tingkatPrestasi = $tingkatPrestasi;
    }

    // Getter spesifik
    public function getJenisPrestasi(): string { return $this->jenisPrestasi; }
    public function getTingkatPrestasi(): string { return $this->tingkatPrestasi; }

    // [POLIMORFISME] Potongan/insentif apresiasi prestasi sebesar Rp50.000
    public function hitungTotalBiaya(): float {
        return $this->biayaPendaftaranDasar - 50000.00;
    }

    public function tampilkanInfoJalur(): void {
        echo "=== JALUR PRESTASI ===<br>";
        echo "Jenis Prestasi: " . $this->jenisPrestasi . "<br>";
        echo "Tingkat: " . $this->tingkatPrestasi . "<br>";
    }

    /**
     * Metode Query Spesifik untuk mengambil semua data Prestasi
     */
    public static function getDaftarPrestasi(PDO $db): array {
        $sql = "SELECT id_pendaftaran, nama_calon, asal_sekolah, nilai_ujian, biaya_pendaftaran_dasar, jenis_prestasi, tingkat_prestasi 
                FROM pendaftaran 
                WHERE jalur_pendaftaran = 'Prestasi'";
        
        $stmt = $db->query($sql);
        $rows = $stmt->fetchAll();
        
        $daftarPrestasi = [];
        foreach ($rows as $row) {
            $obj = new self(
                $row['nama_calon'],
                $row['asal_sekolah'],
                (float)$row['nilai_ujian'],
                (float)$row['biaya_pendaftaran_dasar'],
                $row['jenis_prestasi'],
                $row['tingkat_prestasi']
            );
            $obj->setIdPendaftaran((int)$row['id_pendaftaran']);
            $daftarPrestasi[] = $obj;
        }
        
        return $daftarPrestasi;
    }
}   