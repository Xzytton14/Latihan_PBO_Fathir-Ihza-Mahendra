<?php

class PendaftaranKedinasan extends Pendaftaran {
    // Properti tambahan (camelCase)
    private string $skIkatanDinas;
    private string $instansiSponsor;

    public function __construct(
        string $namaCalon, 
        string $asalSekolah, 
        float $nilaiUjian, 
        float $biayaDasar, 
        string $skIkatanDinas, 
        string $instansiSponsor
    ) {
        parent::__construct($namaCalon, $asalSekolah, $nilaiUjian, $biayaDasar);
        $this->skIkatanDinas = $skIkatanDinas;
        $this->instansiSponsor = $instansiSponsor;
    }

    // Getter spesifik
    public function getSkIkatanDinas(): string { return $this->skIkatanDinas; }
    public function getInstansiSponsor(): string { return $this->instansiSponsor; }

    // [POLIMORFISME] Surcharge/biaya tambahan administrasi dinas sebesar 25% (x 1.25)
    public function hitungTotalBiaya(): float {
        return $this->biayaPendaftaranDasar * 1.25;
    }

    public function tampilkanInfoJalur(): void {
        echo "=== JALUR KEDINASAN ===<br>";
        echo "Instansi Sponsor: " . $this->instansiSponsor . "<br>";
        echo "No SK Dinas: " . $this->skIkatanDinas . "<br>";
    }

    /**
     * Metode Query Spesifik untuk mengambil semua data Kedinasan
     */
    public static function getDaftarKedinasan(PDO $db): array {
        $sql = "SELECT id_pendaftaran, nama_calon, asal_sekolah, nilai_ujian, biaya_pendaftaran_dasar, sk_ikatan_dinas, instansi_sponsor 
                FROM pendaftaran 
                WHERE jalur_pendaftaran = 'Kedinasan'";
        
        $stmt = $db->query($sql);
        $rows = $stmt->fetchAll();
        
        $daftarKedinasan = [];
        foreach ($rows as $row) {
            $obj = new self(
                $row['nama_calon'],
                $row['asal_sekolah'],
                (float)$row['nilai_ujian'],
                (float)$row['biaya_pendaftaran_dasar'],
                $row['sk_ikatan_dinas'],
                $row['instansi_sponsor']
            );
            $obj->setIdPendaftaran((int)$row['id_pendaftaran']);
            $daftarKedinasan[] = $obj;
        }
        
        return $daftarKedinasan;
    }
}