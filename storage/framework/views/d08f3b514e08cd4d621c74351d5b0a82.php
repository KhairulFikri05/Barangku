<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor Barang - BARANGKU</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #f8fafc; color: #0f172a; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; }
        .form-card { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); width: 100%; max-width: 500px; }
        .header-text { text-align: center; margin-bottom: 30px; }
        .header-text h2 { font-size: 24px; font-weight: 700; margin-bottom: 8px; }
        .header-text p { color: #64748b; font-size: 14px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; color: #334155; }
        input, select, textarea { width: 100%; padding: 12px 15px; border: 1px solid #cbd5e1; border-radius: 10px; font-size: 14px; outline: none; transition: all 0.3s; }
        input:focus, select:focus, textarea:focus { border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }
        .btn-submit { width: 100%; padding: 14px; background: #4f46e5; color: white; border: none; border-radius: 10px; font-size: 15px; font-weight: 600; cursor: pointer; transition: background 0.3s; }
        .btn-submit:hover { background: #4338ca; }
        .btn-back { display: block; text-align: center; margin-top: 20px; color: #64748b; text-decoration: none; font-size: 14px; font-weight: 500; }
        .btn-back:hover { color: #0f172a; }
    </style>
</head>
<body>

    <div class="form-card">
        <div class="header-text">
            <h2>📝 Buat Laporan Baru</h2>
            <p>Isi detail barang yang hilang atau ditemukan</p>
        </div>

        <form action="/kelola/store" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label>Kategori Barang</label>
                <select name="kategori_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($kat->id); ?>"><?php echo e($kat->nama_kategori); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" placeholder="Contoh: Kunci Motor Vario" required>
            </div>
            <div class="form-group">
                <label>Lokasi Terakhir</label>
                <input type="text" name="lokasi_terakhir" placeholder="Contoh: Parkiran Fakultas" required>
            </div>
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal_hilang" required>
            </div>
            <div class="form-group">
                <label>Ciri-Ciri Barang</label>
                <textarea name="ciri_ciri" rows="3" placeholder="Sebutkan warna, bentuk, atau tanda khusus..." required></textarea>
            </div>
            <div class="form-group">
                <label>Status Laporan</label>
                <select name="status_barang" required>
                    <option value="Belum Ditemukan">Kehilangan Barang</option>
                    <option value="Ditemukan">Menemukan Barang</option>
                </select>
            </div>
            <div class="form-group">
                <label>Foto Bukti Barang</label>
                <input type="file" name="foto_barang" accept="image/*">
            </div>
            <button type="submit" class="btn-submit">Kirim Laporan</button>
        </form>
        
        <a href="/" class="btn-back">← Kembali ke Beranda</a>
    </div>

</body>
</html><?php /**PATH C:\laragon\www\barangku\resources\views/lapor.blade.php ENDPATH**/ ?>