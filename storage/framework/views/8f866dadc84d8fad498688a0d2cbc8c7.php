<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/beranda.css">
    <title>Barangku: Platform Lapor & Temukan Barang Hilang</title>
    
</head>
<body>

<nav class="navbar">
    <div class="logo-area">
        <div class="logo">BARANGKU<span>.</span></div>
    </div>
    <div class="nav-links">
        <a href="/">Beranda</a>
        
        <a href="/#cara-kerja">Cara Kerja</a>
        
        <a href="/#bantuan">Bantuan</a>
        
        <a href="/kelola" class="btn-login">Masuk Admin</a>
    </div>
</nav>

    <div class="hero">
        <div class="hero-badge">Platform Komunitas Terbuka</div>
        <h1>Temukan Barang yang Hilang. Laporkan Temuan Anda.</h1>
        <p>Platform digital cerdas untuk mempermudah pelacakan, pelaporan, dan pengembalian barang hilang secara transparan antar sesama pengguna di sekitarmu.</p>
        
        <div class="hero-btns">
            <a href="/lapor" class="btn btn-lapor-hilang">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                Lapor Kehilangan
            </a>
            
            <a href="/lapor" class="btn btn-lapor-temu">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                Lapor Temuan Barang
            </a>
        </div>
    </div>

    <div class="search-container">
        <form id="searchForm" action="/" method="GET" class="search-bar">
            <input type="hidden" name="status" id="statusInput" value="<?php echo e(request('status', 'Semua')); ?>">

            <div class="search-wrapper">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text" name="search" class="search-input" placeholder="Masukkan nama barang atau lokasi pencarian..." value="<?php echo e(request('search')); ?>">
            </div>
            
            <div class="filters">
                <span class="<?php echo e(request('status', 'Semua') == 'Semua' ? 'active' : ''); ?>" onclick="pilihKategori('Semua')">Semua Laporan</span>
                <span class="<?php echo e(request('status') == 'Kehilangan' ? 'active' : ''); ?>" onclick="pilihKategori('Kehilangan')">Kehilangan</span>
                <span class="<?php echo e(request('status') == 'Ditemukan' ? 'active' : ''); ?>" onclick="pilihKategori('Ditemukan')">Ditemukan</span>
            </div>
        </form>
    </div>

    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Feed Laporan Terbaru</h2>
            <div class="stats-count">Menampilkan data langsung dari database aktif</div>
        </div>
        
        <div class="grid">
            <?php $__empty_1 = true; $__currentLoopData = $data_barang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="card" id="kartu-<?php echo e($item->id); ?>">
                
                <div class="card-img-header <?php if($item->status_barang == 'Belum Ditemukan'): ?> bg-pattern-lost <?php elseif($item->status_barang == 'Ditemukan'): ?> bg-pattern-found <?php else: ?> bg-pattern-selesai <?php endif; ?>">
                    <?php if($item->foto_barang): ?>
                        <div class="card-icon-box" style="padding: 0; overflow: hidden; border: none; width: 150px; height: 150px; flex-shrink: 0; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                            <img src="<?php echo e(asset($item->foto_barang)); ?>" alt="<?php echo e($item->nama_barang); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    <?php else: ?>
                        <div class="card-icon-box" style="display: flex; justify-content: center; align-items: center; background: white; border: none; width: 150px; height: 150px; flex-shrink: 0; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--text-dark)" stroke-width="1.5">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l-7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                <line x1="12" y1="22.08" x2="12" y2="12"></line>
                            </svg>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($item->status_barang == 'Belum Ditemukan'): ?>
                        <span class="badge badge-hilang">Kehilangan</span>
                    <?php elseif($item->status_barang == 'Ditemukan'): ?>
                        <span class="badge badge-ketemu">Ditemukan</span>
                    <?php else: ?>
                        <span class="badge badge-selesai">Selesai</span>
                    <?php endif; ?>
                    
                </div>

                <div class="card-body">
                    <div class="card-title"><?php echo e($item->nama_barang); ?></div>
                    
                    <div class="details-list">
                        <div class="card-detail">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            <span><?php echo e($item->lokasi_terakhir); ?></span>
                        </div>
                        <div class="card-detail">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            <span><?php echo e(\Carbon\Carbon::parse($item->tanggal_hilang)->translatedFormat('d F Y')); ?></span>
                        </div>
                        <div class="card-detail">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2.5"><line x1="4" y1="9" x2="20" y2="9"></line><line x1="4" y1="15" x2="20" y2="15"></line><line x1="10" y1="3" x2="10" y2="21"></line><line x1="14" y1="3" x2="14" y2="21"></line></svg>
                            <span><?php echo e($item->ciri_ciri); ?></span>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                            <?php if($item->status_barang == 'Belum Ditemukan'): ?>
                                <button type="button" onclick="bukaModal('Hubungi Pelapor', '<?php echo e($item->nama_barang); ?>', 'Sistem mengenali enkripsi enkoder pelapor aman. Silakan hubungi Unit Layanan Hubungan Publik Terintegrasi untuk proses verifikasi kontak utama secara langsung.')" class="btn-action btn-hubungi" style="cursor: pointer;">Hubungi Pelapor</button>
                                
                            <?php elseif($item->status_barang == 'Ditemukan'): ?>
                                <button type="button" onclick="bukaModal('Proses Klaim Barang', '<?php echo e($item->nama_barang); ?>', 'Sistem sedang menyiapkan token berkas pencocokan kepemilikan. Silakan bawa bukti validitas atau tanda pengenal fisik barang Anda ke loket utama komunitas.')" class="btn-action btn-klaim" style="cursor: pointer;">Proses Klaim</button>
                                
                            <?php else: ?>
                                <button type="button" onclick="if(confirm('Apakah Anda ingin menyembunyikan laporan yang sudah selesai ini dari Beranda?')) { document.getElementById('kartu-<?php echo e($item->id); ?>').style.display = 'none'; }" class="btn-action btn-selesai" style="cursor: pointer;">Tutup Laporan</button>
                            <?php endif; ?>
                    </div>
                </div>
                
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; background: white; border-radius: 16px; border: 1px solid var(--border-color); color: var(--text-muted); font-size: 14px;">
                Tidak ada data laporan yang cocok dengan kriteria pencarian atau kategori ini.
            </div>
            <?php endif; ?>
        </div>
    </div>

    <div id="modalSistem" class="modal-overlay" onclick="tutupModalOutside(event)">
        <div class="modal-box">
            <div class="modal-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--brand)" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
            </div>
            <div id="modalTitle" class="modal-title">Aksi Sistem</div>
            <div id="modalItem" class="modal-info-card">Nama Barang</div>
            <div id="modalDesc" class="modal-desc">Deskripsi instruksi sistem informasi penanganan log.</div>
            <button class="btn-close-modal" onclick="tutupModal()">Mengerti, Tutup</button>
        </div>
    </div>

    <div id="cara-kerja" style="scroll-margin-top: 100px; max-width: 1000px; margin: 80px auto 60px auto; padding: 0 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <div style="text-align: center; margin-bottom: 50px;">
            <h2 style="color: #1a202c; font-weight: 800; font-size: 30px; margin-bottom: 12px; letter-spacing: -0.5px;">Bagaimana Sistem Ini Bekerja?</h2>
            <p style="color: #718096; font-size: 16px; max-width: 500px; margin: 0 auto; line-height: 1.6;">Panduan praktis untuk melaporkan, melacak, dan mengklaim barang Anda dengan aman dan terintegrasi.</p>
        </div>

        <div style="display: grid; gap: 25px; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));">
            
            <div style="background: white; padding: 30px 25px; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border-top: 4px solid #e74c3c; transition: 0.3s;">
                <div style="background-color: #e74c3c; color: white; width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 20px; margin-bottom: 20px; box-shadow: 0 4px 10px rgba(231, 76, 60, 0.25);">1</div>
                <h4 style="margin: 0 0 12px 0; color: #2d3748; font-size: 18px; font-weight: 700;">Buat Laporan</h4>
                <p style="margin: 0; color: #718096; line-height: 1.6; font-size: 14px;">Kehilangan atau menemukan barang? Segera isi form laporan. Cantumkan ciri spesifik dan foto agar barang dikenali oleh sistem.</p>
            </div>

            <div style="background: white; padding: 30px 25px; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border-top: 4px solid #f59e0b; transition: 0.3s;">
                <div style="background-color: #f59e0b; color: white; width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 20px; margin-bottom: 20px; box-shadow: 0 4px 10px rgba(245, 158, 11, 0.25);">2</div>
                <h4 style="margin: 0 0 12px 0; color: #2d3748; font-size: 18px; font-weight: 700;">Pantau Beranda</h4>
                <p style="margin: 0; color: #718096; line-height: 1.6; font-size: 14px;">Laporan langsung tampil di halaman utama. Sistem menampilkan status secara <i>real-time</i> hingga ada kecocokan data dari pihak lain.</p>
            </div>

            <div style="background: white; padding: 30px 25px; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border-top: 4px solid #3b82f6; transition: 0.3s;">
                <div style="background-color: #3b82f6; color: white; width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 20px; margin-bottom: 20px; box-shadow: 0 4px 10px rgba(59, 130, 246, 0.25);">3</div>
                <h4 style="margin: 0 0 12px 0; color: #2d3748; font-size: 18px; font-weight: 700;">Verifikasi & Klaim</h4>
                <p style="margin: 0; color: #718096; line-height: 1.6; font-size: 14px;">Klik tombol aksi pada kartu. Sistem terenkripsi kami akan memandu Anda melakukan pencocokan bukti kepemilikan di loket utama.</p>
            </div>

            <div style="background: white; padding: 30px 25px; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border-top: 4px solid #10b981; transition: 0.3s;">
                <div style="background-color: #10b981; color: white; width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 20px; margin-bottom: 20px; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.25);">4</div>
                <h4 style="margin: 0 0 12px 0; color: #2d3748; font-size: 18px; font-weight: 700;">Kasus Selesai</h4>
                <p style="margin: 0; color: #718096; line-height: 1.6; font-size: 14px;">Setelah serah terima berhasil, status berubah jadi <b>Selesai</b>. Laporan dapat disembunyikan agar <i>feed</i> fokus pada barang yang masih aktif.</p>
            </div>

        </div>
    </div>

    <div id="bantuan" style="scroll-margin-top: 100px; max-width: 1000px; margin: 60px auto 80px auto; padding: 0 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        <div style="text-align: center; margin-bottom: 40px;">
            <h2 style="color: #1a202c; font-weight: 800; font-size: 30px; margin-bottom: 12px; letter-spacing: -0.5px;">Pusat Bantuan</h2>
            <p style="color: #718096; font-size: 16px; max-width: 500px; margin: 0 auto; line-height: 1.6;">Ada pertanyaan atau kendala teknis? Kami siap membantu Anda.</p>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 20px;">
            
            <div style="flex: 1; min-width: 300px; background: white; padding: 30px; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid #edf2f7;">
                <h4 style="color: #2b6cb0; margin: 0 0 20px 0; font-size: 18px; display: flex; align-items: center; gap: 10px;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                    Pertanyaan Umum (FAQ)
                </h4>
                <div style="margin-bottom: 15px;">
                    <strong style="color: #2d3748; display: block; margin-bottom: 5px;">Bagaimana jika saya salah lapor?</strong>
                    <span style="color: #718096; font-size: 14px; line-height: 1.5;">Anda dapat menghubungi admin untuk mengubah atau menghapus data laporan Anda dari sistem.</span>
                </div>
                <div>
                    <strong style="color: #2d3748; display: block; margin-bottom: 5px;">Apakah sistem ini memungut biaya?</strong>
                    <span style="color: #718096; font-size: 14px; line-height: 1.5;">Tidak. Layanan BARANGKU 100% gratis untuk seluruh mahasiswa dan civitas akademika.</span>
                </div>
            </div>

            <div style="flex: 1; min-width: 300px; background: linear-gradient(135deg, #2c3e50, #34495e); color: white; padding: 30px; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                <h4 style="color: #edf2f7; margin: 0 0 15px 0; font-size: 18px; display: flex; align-items: center; gap: 10px;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    Hubungi Admin Terpadu
                </h4>
                <p style="color: #cbd5e0; font-size: 14px; line-height: 1.6; margin-bottom: 20px;">
                    Butuh bantuan langsung terkait pencocokan barang atau kendala teknis? Silakan kunjungi atau hubungi layanan kami:
                </p>
                <div style="font-size: 14px; line-height: 1.8;">
                    <div>📍 <strong>Lokasi:</strong> Lab Terpadu Informatika USK</div>
                    <div>📧 <strong>Email:</strong> admin.barangku@usk.ac.id</div>
                    <div>📞 <strong>Hotline:</strong> 0812-3456-7890</div>
                </div>
            </div>

        </div>
    </div>

    <a href="/kelola" style="position: fixed; bottom: 30px; right: 30px; background-color: #2c3e50; color: #ffffff; padding: 12px 24px; border-radius: 50px; text-decoration: none; font-weight: bold; font-family: sans-serif; box-shadow: 0 6px 15px rgba(0,0,0,0.3); z-index: 9999; display: flex; align-items: center; gap: 8px; transition: 0.3s;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
        Masuk Halaman Admin
    </a>

    <script>
        // Logika Pengiriman Kategori Otomatis
        function pilihKategori(statusValue) {
            document.getElementById('statusInput').value = statusValue;
            document.getElementById('searchForm').submit();
        }

        // Logika Pop Up Jendela Informasi
        function bukaModal(tindakan, namaBarang, deskripsi) {
            document.getElementById('modalTitle').innerText = tindakan;
            document.getElementById('modalItem').innerText = "📦 " + namaBarang;
            document.getElementById('modalDesc').innerText = deskripsi;
            document.getElementById('modalSistem').classList.add('active');
        }

        function tutupModal() {
            document.getElementById('modalSistem').classList.remove('active');
        }

        function tutupModalOutside(e) {
            if (e.target.id === 'modalSistem') {
                tutupModal();
            }
        }
    </script>

</body>
</html><?php /**PATH C:\laragon\www\barangku\resources\views/beranda.blade.php ENDPATH**/ ?>