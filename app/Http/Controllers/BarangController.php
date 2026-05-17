<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $query = Barang::query();

        // 1. FILTER KATA KUNCI (Jika user mengetik di kolom pencarian)
        if ($request->has('search') && $request->search != '') {
            $keyword = $request->search;
            $query->where(function($q) use ($keyword) {
                $q->where('nama_barang', 'like', '%' . $keyword . '%')
                  ->orWhere('lokasi_terakhir', 'like', '%' . $keyword . '%')
                  ->orWhere('ciri_ciri', 'like', '%' . $keyword . '%');
            });
        }

        // 2. FILTER KATEGORI STATUS (Jika user mengklik tombol kategori)
        if ($request->has('status') && $request->status != '' && $request->status != 'Semua') {
            if ($request->status == 'Kehilangan') {
                $query->where('status_barang', 'Belum Ditemukan');
            } elseif ($request->status == 'Ditemukan') {
                $query->where('status_barang', 'Ditemukan');
            }
        }

        // Ambil data hasil filter ganda
        $data_barang = $query->get();
        
        return view('beranda', compact('data_barang'));
    }
}