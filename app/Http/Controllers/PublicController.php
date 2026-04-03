<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        // Hitung statistik untuk transparansi publik
        $totalPemasukan = Transaksi::where('jenis', 'pemasukan')->sum('nominal');
        $totalPengeluaran = Transaksi::where('jenis', 'pengeluaran')->sum('nominal');
        $saldoKas = $totalPemasukan - $totalPengeluaran;

        // Ambil 10 transaksi terakhir untuk ditampilkan di tabel
        $transaksiTerbaru = Transaksi::with('kategori')
            ->orderBy('tanggal_transaksi', 'desc')
            ->take(10)
            ->get();

        return view('welcome', compact('totalPemasukan', 'totalPengeluaran', 'saldoKas', 'transaksiTerbaru'));
    }
}