<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangku: Platform Lapor & Temukan Barang Hilang</title>
    <style>
        /* Modern CSS Variables & Reset */
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        :root {
            --bg-main: #f8fafc;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --brand: #4f46e5;
            --brand-light: #e0e7ff;
            --lost-bg: #fef2f2;
            --lost-text: #dc2626;
            --found-bg: #f0fdf4;
            --found-text: #16a34a;
            --border-color: #e2e8f0;
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-dark);
            -webkit-font-smoothing: antialiased;
        }

        /* Navbar */
        .navbar {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            padding: 16px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .navbar .logo-area {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar .logo {
            font-size: 20px;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: -0.5px;
        }
        
        .navbar .logo span {
            color: var(--brand);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 500;
            font-size: 14px;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: var(--text-dark);
        }

        .btn-login {
            background-color: var(--text-dark);
            color: white !important;
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 600 !important;
            transition: transform 0.2s, background-color 0.2s;
        }

        .btn-login:hover {
            background-color: #1e293b;
            transform: translateY(-1px);
        }

        /* Marketplace Hero Section */
        .hero {
            text-align: center;
            padding: 80px 20px 60px;
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-badge {
            background-color: var(--brand-light);
            color: var(--brand);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
        }

        .hero h1 {
            font-size: 42px;
            font-weight: 800;
            letter-spacing: -1px;
            line-height: 1.2;
            margin-bottom: 16px;
            color: var(--text-dark);
        }

        .hero p {
            font-size: 16px;
            color: var(--text-muted);
            margin-bottom: 36px;
            line-height: 1.6;
        }

        .hero-btns {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .hero-btns .btn {
            padding: 14px 28px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }
        
        .btn-lapor-hilang { background-color: #ef4444; color: white; }
        .btn-lapor-hilang:hover { background-color: #dc2626; box-shadow: 0 10px 15px -3px rgba(239, 68, 68, 0.2); }
        
        .btn-lapor-temu { background-color: #22c55e; color: white; }
        .btn-lapor-temu:hover { background-color: #16a34a; box-shadow: 0 10px 15px -3px rgba(34, 197, 94, 0.2); }
        
        .btn-cari { background-color: white; color: var(--text-dark); border: 1px solid var(--border-color); }
        .btn-cari:hover { background-color: #f1f5f9; }

        /* Integrated Search & Filter Bar Form */
        .search-container {
            max-width: 1100px;
            margin: 0 auto 40px;
            padding: 0 20px;
        }

        .search-bar {
            background: white;
            padding: 10px 14px;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .search-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 50%;
            padding-left: 10px;
        }

        .search-input {
            width: 100%;
            border: none;
            font-size: 14px;
            font-weight: 500;
            outline: none;
            color: var(--text-dark);
        }

        .filters {
            display: flex;
            gap: 8px;
        }

        .filters span {
            padding: 8px 18px;
            background: #f1f5f9;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.2s;
            user-select: none;
        }

        .filters span:hover {
            background: #e2e8f0;
            color: var(--text-dark);
        }

        .filters .active {
            background: var(--text-dark) !important;
            color: white !important;
        }

        /* Premium Grid & Cards Layout */
        .container {
            max-width: 1100px;
            margin: 0 auto 80px;
            padding: 0 20px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text-dark);
            letter-spacing: -0.5px;
        }

        .stats-count {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 500;
        }
        
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
        }

        .card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            transition: transform 0.3s, box-shadow 0.3s;
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02); 
        }
        
        /* Thumbnail Estetik */
        .card-img-header {
            height: 140px;
            position: relative;
            display: flex;
            align-items: center;
            padding: 24px;
        }

        .bg-pattern-lost { background: linear-gradient(135deg, #ffeded 0%, #facdcd 100%); }
        .bg-pattern-found { background: linear-gradient(135deg, #e6fcf5 0%, #c3fae8 100%); }
        .bg-pattern-selesai { background: linear-gradient(135deg, #f1f5f9 0%, #cbd5e1 100%); }

        .card-icon-box {
            background: rgba(255, 255, 255, 0.8);
            padding: 12px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }

        .badge {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
        }

        .badge-hilang { background-color: var(--lost-bg); color: var(--lost-text); }
        .badge-ketemu { background-color: var(--found-bg); color: var(--found-text); }
        .badge-selesai { background-color: #f1f5f9; color: #475569; }

        .card-body {
            padding: 24px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 16px;
            letter-spacing: -0.3px;
        }

        .details-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 24px;
        }

        .card-detail {
            font-size: 13px;
            color: #475569;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            line-height: 1.4;
        }

        .card-detail svg {
            flex-shrink: 0;
            margin-top: 2px;
        }
        
        .card-footer {
            margin-top: auto;
        }

        .btn-action {
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;
            gap: 8px;
            padding: 12px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            border: none;
            transition: background-color 0.2s, color 0.2s;
        }

        .btn-hubungi { background-color: #f8fafc; color: var(--text-dark); border: 1px solid var(--border-color); }
        .btn-hubungi:hover { background-color: var(--text-dark); color: white; }
        
        .btn-klaim { background-color: var(--text-dark); color: white; }
        .btn-klaim:hover { background-color: #1e293b; }

        .btn-selesai { background-color: #f1f5f9; color: #94a3b8; border: 1px solid var(--border-color); cursor: not-allowed; }

        /* Premium Modal Popup Styling */
        .modal-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px);
            display: flex; align-items: center; justify-content: center;
            z-index: 1000; opacity: 0; pointer-events: none; transition: all 0.3s ease;
        }
        .modal-overlay.active { opacity: 1; pointer-events: auto; }
        .modal-box {
            background: white; padding: 32px; border-radius: 20px; width: 90%; max-width: 450px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); text-align: center;
            transform: scale(0.9); transition: all 0.3s ease;
        }
        .modal-overlay.active .modal-box { transform: scale(1); }
        .modal-icon {
            width: 56px; height: 56px; background: #f1f5f9; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;
        }
        .modal-title { font-size: 20px; font-weight: 700; color: var(--text-dark); margin-bottom: 8px; }
        .modal-desc { font-size: 14px; color: var(--text-muted); line-height: 1.6; margin-bottom: 24px; }
        .modal-info-card {
            background: #f8fafc; border: 1px solid var(--border-color); padding: 12px;
            border-radius: 12px; font-size: 13px; font-weight: 600; color: var(--brand); margin-bottom: 24px;
        }
        .btn-close-modal {
            background: var(--text-dark); color: white; border: none; padding: 12px 30px;
            border-radius: 10px; font-weight: 600; cursor: pointer; width: 100%; transition: background 0.2s;
        }
        .btn-close-modal:hover { background: #1e293b; }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo-area">
            <div class="logo">BARANGKU<span>.</span></div>
        </div>
        <div class="nav-links">
            <a href="#">Beranda</a>
            <a href="#">Cara Kerja</a>
            <a href="#">Bantuan</a>
            <a href="#" class="btn-login">Masuk / Daftar</a>
        </div>
    </nav>

    <div class="hero">
        <div class="hero-badge">Platform Komunitas Terbuka</div>
        <h1>Temukan Barang yang Hilang. Laporkan Temuan Anda.</h1>
        <p>Platform digital cerdas untuk mempermudah pelacakan, pelaporan, dan pengembalian barang hilang secara transparan antar sesama pengguna di sekitarmu.</p>
        
        <div class="hero-btns">
            <a href="#" class="btn btn-lapor-hilang">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                Lapor Kehilangan
            </a>
            <a href="#" class="btn btn-lapor-temu">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                Lapor Temuan Barang
            </a>
            <a href="#" class="btn btn-cari">Cari Barang</a>
        </div>
    </div>

    <div class="search-container">
        <form id="searchForm" action="/" method="GET" class="search-bar">
            <input type="hidden" name="status" id="statusInput" value="{{ request('status', 'Semua') }}">

            <div class="search-wrapper">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                <input type="text" name="search" class="search-input" placeholder="Masukkan nama barang atau lokasi pencarian..." value="{{ request('search') }}">
            </div>
            
            <div class="filters">
                <span class="{{ request('status', 'Semua') == 'Semua' ? 'active' : '' }}" onclick="pilihKategori('Semua')">Semua Laporan</span>
                <span class="{{ request('status') == 'Kehilangan' ? 'active' : '' }}" onclick="pilihKategori('Kehilangan')">Kehilangan</span>
                <span class="{{ request('status') == 'Ditemukan' ? 'active' : '' }}" onclick="pilihKategori('Ditemukan')">Ditemukan</span>
            </div>
        </form>
    </div>

    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Feed Laporan Terbaru</h2>
            <div class="stats-count">Menampilkan data langsung dari database aktif</div>
        </div>
        
        <div class="grid">
            @forelse($data_barang as $item)
            <div class="card">
                
                <div class="card-img-header @if($item->status_barang == 'Belum Ditemukan') bg-pattern-lost @elseif($item->status_barang == 'Ditemukan') bg-pattern-found @else bg-pattern-selesai @endif">
                    <div class="card-icon-box">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--text-dark)" stroke-width="1.8"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l-7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                    </div>
                    @if($item->status_barang == 'Belum Ditemukan')
                        <span class="badge badge-hilang">Kehilangan</span>
                    @elseif($item->status_barang == 'Ditemukan')
                        <span class="badge badge-ketemu">Ditemukan</span>
                    @else
                        <span class="badge badge-selesai">Selesai</span>
                    @endif
                </div>
                
                <div class="card-body">
                    <div class="card-title">{{ $item->nama_barang }}</div>
                    
                    <div class="details-list">
                        <div class="card-detail">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            <span>{{ $item->lokasi_terakhir }}</span>
                        </div>
                        <div class="card-detail">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            <span>{{ \Carbon\Carbon::parse($item->tanggal_hilang)->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="card-detail">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="2.5"><line x1="4" y1="9" x2="20" y2="9"></line><line x1="4" y1="15" x2="20" y2="15"></line><line x1="10" y1="3" x2="10" y2="21"></line><line x1="14" y1="3" x2="14" y2="21"></line></svg>
                            <span>{{ $item->ciri_ciri }}</span>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        @if($item->status_barang == 'Belum Ditemukan')
                            <button type="button" onclick="bukaModal('Hubungi Pelapor', '{{ $item->nama_barang }}', 'Sistem mengenali enkripsi enkoder pelapor aman. Silakan hubungi Unit Layanan Hubungan Publik Terintegrasi untuk proses verifikasi kontak utama secara langsung.')" class="btn-action btn-hubungi" style="cursor: pointer;">Hubungi Pelapor</button>
                        @elseif($item->status_barang == 'Ditemukan')
                            <button type="button" onclick="bukaModal('Proses Klaim Barang', '{{ $item->nama_barang }}', 'Sistem sedang menyiapkan token berkas pencocokan kepemilikan. Silakan bawa bukti validitas atau tanda pengenal fisik barang Anda ke loket utama komunitas.')" class="btn-action btn-klaim" style="cursor: pointer;">Proses Klaim</button>
                        @else
                            <button type="button" class="btn-action btn-selesai">Barang Kembali</button>
                        @endif
                    </div>
                </div>
                
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; background: white; border-radius: 16px; border: 1px solid var(--border-color); color: var(--text-muted); font-size: 14px;">
                Tidak ada data laporan yang cocok dengan kriteria pencarian atau kategori ini.
            </div>
            @endforelse
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
</html>