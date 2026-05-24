<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Barang;
use App\Models\Kategori;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        // PERBAIKAN: Wajib tambahkan with('kategori') agar tabel berelasi ikut terbaca!
        $query = Barang::with('kategori')->orderBy('created_at', 'desc');

        // 1. FILTER KATA KUNCI (Jika user mengetik di kolom pencarian)
        if ($request->has('search') && $request->search != '') {
            $keyword = $request->search;
            $query->where(function($q) use ($keyword) {
                $q->where('nama_barang', 'like', '%' . $keyword . '%')
                  ->orWhere('lokasi_terakhir', 'like', '%' . $keyword . '%')
                  ->orWhere('ciri_ciri', 'like', '%' . $keyword . '%');
            });
        }

        // 2. Sembunyikan otomatis laporan yang sudah "Selesai" dari Beranda
        $query->where('status_barang', '!=', 'Selesai');

        // 3. FILTER KATEGORI STATUS (Jika user mengklik tombol kategori)
        if ($request->has('status') && $request->status != '' && $request->status != 'Semua') {
            if ($request->status == 'Kehilangan') {
                $query->where('status_barang', 'Belum Ditemukan');
            } elseif ($request->status == 'Ditemukan') {
                $query->where('status_barang', 'Ditemukan');
            }
        }
        
        $data_barang = $query->get();
        $kategoris = \App\Models\Kategori::all(); // Tarik data relasinya
        return view('beranda', compact('data_barang', 'kategoris')); // Sisipkan ke view
    }

    public function kelola()
    {
        // READ: Mengambil data barang berserta nama kategorinya (Relasi)
        $data_barang = Barang::with('kategori')->orderBy('created_at', 'desc')->get();
        $kategoris = Kategori::all();
        
        return view('kelola', compact('data_barang', 'kategoris'));
    }

    public function store(Request $request)
    {
        $pathFoto = null;
        if ($request->hasFile('foto_barang')) {
            $file = $request->file('foto_barang');
            // Buat nama unik agar foto tidak tertimpa
            $namaFile = time() . '_' . $file->getClientOriginalName();
            // Pindahkan langsung ke folder public/uploads
            $file->move(public_path('uploads'), $namaFile);
            $pathFoto = 'uploads/' . $namaFile;
        }

        // 1. CREATE: Menambahkan data menggunakan metode create()
        Barang::create([
            'kategori_id' => $request->kategori_id,
            'nama_barang' => $request->nama_barang,
            'lokasi_terakhir' => $request->lokasi_terakhir,
            'tanggal_hilang' => $request->tanggal_hilang,
            'ciri_ciri' => $request->ciri_ciri,
            'status_barang' => $request->status_barang,
            'foto_barang' => $pathFoto
        ]);

        return redirect('/')->with('success', 'Laporan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // 2. FIND: Mencari data spesifik menggunakan metode find()
        $edit_barang = Barang::find($id); 
        $data_barang = Barang::with('kategori')->orderBy('created_at', 'desc')->get();
        $kategoris = Kategori::all();

        return view('kelola', compact('data_barang', 'kategoris', 'edit_barang'));
    }

    public function update(Request $request, $id)
    {
        // 1. Cari data barang yang mau diedit
        $barang = Barang::findOrFail($id);

        // 2. Ambil semua inputan teks kecuali foto dulu
        $data = $request->except('foto_barang');

        // 3. Cek apakah user ada mengupload FOTO BARU
        if ($request->hasFile('foto_barang')) {
            
            // Opsional: Hapus foto lama di folder public biar gak menuh-menuhin memori
            if ($barang->foto_barang && file_exists(public_path($barang->foto_barang))) {
                @unlink(public_path($barang->foto_barang));
            }

            // Proses simpan foto baru (samakan dengan logika store-mu kemarin)
            $file = $request->file('foto_barang');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $nama_file);
            
            // Masukkan path foto baru ke dalam array data
            $data['foto_barang'] = 'uploads/' . $nama_file;
        }

        // 4. Update data ke database
        $barang->update($data);

        // 5. Kembalikan ke halaman kelola admin
        return redirect('/kelola')->with('success', 'Data laporan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // 4. DELETE: Menghapus data menggunakan metode find() dan delete()
        $barang = Barang::find($id);
        $barang->delete();

        return redirect('/kelola')->with('success', 'Laporan berhasil dihapus!');
    }

    public function lapor()
    {
        // Hanya memanggil kategori untuk ditaruh di dropdown form
        $kategoris = Kategori::all();
        return view('lapor', compact('kategoris'));
    }

}