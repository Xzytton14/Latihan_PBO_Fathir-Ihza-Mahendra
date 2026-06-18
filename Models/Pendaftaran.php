<?php

abstract class Pendaftaran {
    // Atribut Global (Induk) menggunakan camelCase
    protected ?int $idPendaftaran = null;
    protected string $namaCalon;
    protected string $asalSekolah;
    protected float $nilaiUjian;
    protected float $biayaPendaftaranDasar; // Sekarang sudah didefinisikan dengan jelas

    // Constructor untuk menginisialisasi atribut global
    public function __construct(
        string $namaCalon, 
        string $asalSekolah, 
        float $nilaiUjian, 
        float $biayaPendaftaranDasar
    ) {
        $this->namaCalon = $namaCalon;
        $this->asalSekolah = $asalSekolah;
        $this->nilaiUjian = $nilaiUjian;
        $this->biayaPendaftaranDasar = $biayaPendaftaranDasar;
    }

    // --- GETTER & SETTER GLOBAL ---
    
    public function getIdPendaftaran(): ?int { 
        return $this->idPendaftaran; 
    }
    
    public function setIdPendaftaran(int $id): void {
        $this->idPendaftaran = $id;
    }

    public function getNamaCalon(): string { 
        return $this->namaCalon; 
    }

    public function getAsalSekolah(): string { 
        return $this->asalSekolah; 
    }

    public function getNilaiUjian(): float { 
        return $this->nilaiUjian; 
    }

    public function getBiayaPendaftaranDasar(): float { 
        return $this->biayaPendaftaranDasar; 
    }

    // --- ABSTRACT FUNCTIONS ---
    
    // Wajib diimplementasikan oleh kelas anak untuk menghitung total biaya secara spesifik
    abstract public function hitungTotalBiaya(): float;

    // Wajib diimplementasikan oleh kelas anak untuk menampilkan info jalur masing-masing
    abstract public function tampilkanInfoJalur(): void;
}