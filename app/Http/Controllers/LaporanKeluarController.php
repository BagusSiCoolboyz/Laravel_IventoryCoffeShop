<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\GoodsOut;
use Illuminate\Http\Request;

class LaporanKeluarController extends Controller
{
    public function index()
    {
        $barangKeluar = GoodsOut::with('Supplies.MasterGoods')->orderBy('created_at', 'desc')->get();
        return view('halaman.laporan.keluar',[
            'title' => 'Laporan Keluar',
            'header' => 'Laporan Keluar',
            'judul' => 'DATA BAHAN BAKU',
            'data' =>$barangKeluar
        ]);
    }
}
