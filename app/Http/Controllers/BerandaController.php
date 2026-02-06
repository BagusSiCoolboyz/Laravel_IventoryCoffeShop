<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\GoodsOut;
use App\Models\IncomingGoods;
use App\Models\MasterGoods;
use App\Models\Supplies;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index(){
        $totalMasuk = IncomingGoods::count();
        $totalStok = Supplies::count();
        $totalKeluar = GoodsOut::count();
        
        return view('halaman.home',[
        "title" => "Home",
        "header" =>  "Home",
        "judul" => "DATA BAHAN BAKU"
        
        ],compact('totalMasuk', 'totalStok', 'totalKeluar'));
    }
}
