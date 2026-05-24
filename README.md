**Nama: Khairul Fikri**
**NPM: 2408107010032**
**Mata Kuliah: PBW B**
**TUGAS ORM**

# 📦 BARANGKU

**Platform Layanan Kehilangan dan Penemuan Barang Terintegrasi**

BARANGKU adalah sistem informasi berbasis web yang dirancang khusus untuk mengatasi masalah pengelolaan pelaporan barang hilang dan temuan di lingkungan komunitas, fasilitas umum, maupun kawasan kampus. Sistem ini memfasilitasi pertukaran informasi yang cepat, transparan, dan akurat antara pihak yang kehilangan barang dengan pihak penemu, didukung dengan antarmuka yang intuitif serta alur verifikasi yang jelas.

### 📌 Latar Belakang Pengembangan
Seringkali informasi mengenai barang yang hilang atau ditemukan hanya tersebar melalui grup obrolan (WhatsApp/Telegram) yang sifatnya sementara dan mudah tertumpuk oleh pesan lain. Platform **BARANGKU** hadir sebagai wadah sentralisasi pendataan. Dengan sistem ini, riwayat pelaporan tidak akan hilang, mudah dicari, dan status pencarian barang dapat dipantau secara *real-time* hingga kasus dinyatakan selesai.

---

## ✨ Fitur & Fungsionalitas Utama

Sistem ini membagi fungsionalitasnya menjadi dua sisi interaksi utama:

**Bagi Pengguna (Frontend / Beranda):**
- **Sistem Pelaporan Mandiri:** Pengguna dapat mengunggah laporan kehilangan atau penemuan barang secara detail, mencakup nama barang, kategori, ciri-ciri spesifik, lokasi kejadian, hingga lampiran foto pendukung.
- **Indikator Status Dinamis:** Pemantauan kondisi barang secara *real-time* melalui lencana status warna-warni (*Kehilangan*, *Ditemukan*, dan *Selesai*).
- **Auto-Filter & Smart UI:** Sistem secara cerdas menyembunyikan laporan dengan status "Selesai" dari *feed* utama agar halaman tetap bersih dan berfokus pada kasus yang masih aktif.
- **Navigasi Single-Page:** Dilengkapi dengan *smooth-scrolling* dan *floating navbar* untuk pengalaman navigasi yang mulus layaknya aplikasi modern.
- **Interaksi Pop-up Modal:** Proses instruksi klaim dan verifikasi dikemas dalam *modal* dinamis yang informatif.

**Bagi Administrator (Backend / Kelola):**
- **Manajemen Data Terpadu (CRUD):** Panel khusus bagi admin untuk mengawasi seluruh lalu lintas data pelaporan.
- **Modifikasi & Pembaruan:** Admin memiliki wewenang penuh untuk memperbarui (*update*) detail laporan atau mengubah lampiran foto jika terjadi kesalahan *input* dari pengguna.
- **Pembersihan Data:** Fitur penghapusan (*delete*) untuk menjaga integritas dan kebersihan *database* dari data *spam* atau laporan yang tidak valid.

---

## 🛠️ Tumpukan Teknologi (Tech Stack)

Aplikasi ini dikembangkan dengan arsitektur MVC (Model-View-Controller) menggunakan ekosistem berikut:
- **Backend Core:** Framework Laravel (PHP)
- **Database Interaction:** Eloquent ORM & Laravel Migrations
- **Frontend Core:** HTML5, Native CSS3 (Custom Styling)
- **Frontend Interactivity:** JavaScript (DOM Manipulation & Alerts)
- **View Engine:** Laravel Blade Templates
- **Database Management:** MySQL

---

## ⚙️ Panduan Instalasi & Konfigurasi Lokal

### Prasyarat Sistem
Pastikan mesin lokal Anda telah terpasang:
- PHP >= 8.1
- Composer
- MySQL (XAMPP / Laragon / MAMP)

### Langkah-Langkah Instalasi

Pastikan Anda telah menyalakan server MySQL lokal Anda dan membuat *database* kosong (misal: `barangku`). Setelah itu, Anda cukup menyalin blok kode di bawah ini ke terminal Anda:

```bash
# 1. Clone repositori dan masuk ke direktori proyek
git clone [https://github.com/username-kamu/barangku.git](https://github.com/username-kamu/barangku.git)
cd barangku

# 2. Instal seluruh dependensi sistem
composer install

# 3. Salin file environment dan buat application key
cp .env.example .env
php artisan key:generate

# 4. Jangan lupa sesuaikan DB_DATABASE di file .env dengan nama database Anda!
# Setelah disesuaikan, jalankan migrasi tabel
php artisan migrate

# 5. Nyalakan server lokal
php artisan serve
