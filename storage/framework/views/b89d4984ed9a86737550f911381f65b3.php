<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/kelola.css">
    <title>Kelola Laporan - BARANGKU</title>
</head>
<body>

    <div class="header">
        <h1>⚙️ Kelola Laporan Barang</h1>
        <a href="/" class="btn-back">Lihat Beranda</a>
    </div>

    <div class="container">
        <div class="form-section">
            <h3><?php echo e(isset($edit_barang) ? 'Edit Data Laporan' : 'Tambah Laporan Baru'); ?></h3>
            <br>
            <form action="<?php echo e(isset($edit_barang) ? '/kelola/update/'.$edit_barang->id : '/kelola/store'); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label>Kategori Barang (Relasi)</label>
                    <select name="kategori_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($kat->id); ?>" <?php echo e((isset($edit_barang) && $edit_barang->kategori_id == $kat->id) ? 'selected' : ''); ?>>
                                <?php echo e($kat->nama_kategori); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" value="<?php echo e(isset($edit_barang) ? $edit_barang->nama_barang : ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Lokasi Terakhir</label>
                    <input type="text" name="lokasi_terakhir" value="<?php echo e(isset($edit_barang) ? $edit_barang->lokasi_terakhir : ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Hilang/Ditemukan</label>
                    <input type="date" name="tanggal_hilang" value="<?php echo e(isset($edit_barang) ? $edit_barang->tanggal_hilang : ''); ?>" required>
                </div>
                <div class="form-group">
                    <label>Ciri-Ciri</label>
                    <textarea name="ciri_ciri" rows="3" required><?php echo e(isset($edit_barang) ? $edit_barang->ciri_ciri : ''); ?></textarea>
                </div>
                <div class="form-group">
                    <label>Status Laporan</label>
                    <select name="status_barang" required>
                        <option value="Belum Ditemukan" <?php echo e((isset($edit_barang) && $edit_barang->status_barang == 'Belum Ditemukan') ? 'selected' : ''); ?>>Kehilangan</option>
                        <option value="Ditemukan" <?php echo e((isset($edit_barang) && $edit_barang->status_barang == 'Ditemukan') ? 'selected' : ''); ?>>Ditemukan</option>
                        <option value="Selesai" <?php echo e((isset($edit_barang) && $edit_barang->status_barang == 'Selesai') ? 'selected' : ''); ?>>Selesai</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Foto Bukti Barang</label>
                    <input type="file" name="foto_barang" accept="image/*">
                </div>
                <button type="submit" class="btn-submit"><?php echo e(isset($edit_barang) ? 'Simpan Perubahan' : 'Tambah Data'); ?></button>
            </form>
        </div>

        <div class="table-section">
            <h3>Daftar Laporan Aktif</h3>
            <br>
            <table>
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data_barang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><strong><?php echo e($item->nama_barang); ?></strong></td>
                        <td><span class="badge"><?php echo e($item->kategori->nama_kategori); ?></span></td>
                        <td><?php echo e($item->lokasi_terakhir); ?></td>
                        <td><?php echo e($item->status_barang); ?></td>
                        <td>
                            <a href="/kelola/edit/<?php echo e($item->id); ?>" class="btn-edit">Edit</a>
                            <a href="/kelola/delete/<?php echo e($item->id); ?>" class="btn-delete" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html><?php /**PATH C:\laragon\www\barangku\resources\views/kelola.blade.php ENDPATH**/ ?>