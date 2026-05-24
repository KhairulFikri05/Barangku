<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use App\Models\Barang;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat Data Kategori via Eloquent (create)
        $katElektronik = Kategori::create(['nama_kategori' => 'Elektronik & Gadget']);
        $katDokumen = Kategori::create(['nama_kategori' => 'Dokumen & Identitas']);
        $katAksesoris = Kategori::create(['nama_kategori' => 'Aksesoris & Kunci']);

        // 2. Buat Data Barang via Eloquent (create) yang berelasi
        Barang::create([
            'kategori_id' => $katAksesoris->id, // Relasi ke Kunci
            'nama_barang' => 'Kunci Motor Honda Vario',
            'lokasi_terakhir' => 'Parkiran FMIPA USK',
            'tanggal_hilang' => '2026-05-15',
            'ciri_ciri' => 'Gantungan kunci rajutan kaktus hijau, ada remote hitam',
            'status_barang' => 'Selesai'
        ]);

        Barang::create([
            'kategori_id' => $katDokumen->id, // Relasi ke Dompet/Dokumen
            'nama_barang' => 'Dompet Eiger Hitam',
            'lokasi_terakhir' => 'Kantin AAC Dayan Dawood',
            'tanggal_hilang' => '2026-05-16',
            'ciri_ciri' => 'Bahan kain, ada KTM, SIM A, dan kartu ATM',
            'status_barang' => 'Belum Ditemukan'
        ]);

        Barang::create([
            'kategori_id' => $katElektronik->id, // Relasi ke Elektronik
            'nama_barang' => 'Flashdisk Kingston 32GB',
            'lokasi_terakhir' => 'Lab Terpadu Informatika USK',
            'tanggal_hilang' => '2026-05-14',
            'ciri_ciri' => 'Warna silver metalik, isi file laporan praktikum',
            'status_barang' => 'Belum Ditemukan'
        ]);
    }
}