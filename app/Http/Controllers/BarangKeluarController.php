<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\BarangKeluar;
use App\Models\GoodsOut;
use App\Models\MasterGoods;
use App\Models\Supplies;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barang_keluar = GoodsOut::with('Supplies.MasterGoods')->orderBy('created_at', 'desc')->get();

        return view('/halaman/barang-keluar/barang_keluar_new', [
            "title" => "Barang Keluar",
            "header" =>  "Barang Keluar",
            "judul" => "DATA BAHAN BAKU",
            'data' => $barang_keluar

        ]);
    }

    // public function tambah()
    // {
    //     return view('/halaman/barang-keluar/create');
    // }

    public function tambah()
    {
        $data = array(
            'goods' => Supplies::with('MasterGoods')->orderBy('created_at', 'desc')->get()
        );
        return view('halaman.barang-keluar.create_new', compact('data'), [
            "title" => "Barang Keluar",
            "header" =>  "Barang Keluar",
            "judul" => "DATA BAHAN BAKU"
        ]);
    }

    // public function simpan(Request $request)
    // {
    //     //dd($request);
    //     // Validasi input
    //     $request->validate([
    //         'kode_barang' => 'required',
    //         'nama_barang' => 'required',
    //         'kategori' => 'required',
    //         'jumlah_keluar' => 'required|integer|min:1',
    //         'nama_petugas' => 'required',
    //         'tanggal_keluar' => 'required|date',
    //     ], [
    //         'required' => 'Kolom :attribute harus diisi.',
    //         'integer' => 'Kolom :attribute harus berupa angka.',
    //         'min' => 'Kolom :attribute harus minimal :min.',
    //         'date' => 'Kolom :attribute harus berupa tanggal yang valid.',
    //     ]);

    //     // Cek apakah kode_barang dan nama_barang ada di database
    //     $barang = Barang::where('kode_barang', $request->kode_barang)
    //                     ->where('nama_barang', $request->nama_barang)
    //                     ->first();

    //     if (!$barang) {
    //         // Barang tidak ditemukan, kembalikan ke layar dengan pesan error
    //         return redirect()->back()->withErrors(['error' => 'Barang dengan kode dan nama tersebut tidak ditemukan.']);
    //     }

    //     // Cek apakah jumlah barang cukup
    //     if ($barang->jumlah < $request->jumlah_keluar) {
    //         // Jumlah barang tidak cukup, kembalikan ke layar dengan pesan error
    //         return redirect()->back()->withErrors(['error' => 'Jumlah barang yang tersedia tidak mencukupi.']);
    //     }

    //     // Kurangi jumlah barang
    //     $barang->jumlah -= $request->jumlah_keluar;
    //     $barang->save();

    //     // Simpan data barang keluar
    //     $data = [
    //         'kode_barang' => $request->kode_barang,
    //         'nama_barang' => $request->nama_barang,
    //         'kategori' => $request->kategori,
    //         'jumlah_keluar' => $request->jumlah_keluar,
    //         'nama_petugas' => $request->nama_petugas,
    //         'tanggal_keluar' => $request->tanggal_keluar,
    //     ];

    //     BarangKeluar::create($data);

    //     // Redirect ke halaman barang keluar dengan pesan sukses
    //     return redirect()->route('barang_keluar')->with('success', 'Data berhasil ditambahkan dan jumlah barang berhasil dikurangi.');
    // }

    public function simpan(Request $request)
    {
        // Validasi input
        $request->validate([
            'master_goods_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'operator' => 'required',
            'entry_date' => 'required|date',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
            'min' => 'Kolom :attribute harus minimal :min.',
            'date' => 'Kolom :attribute harus berupa tanggal yang valid.',
        ]);

        // Pengecekan apakah barang sudah ada di database
        $supplies = Supplies::where('master_goods_id', $request->master_goods_id)->first();

        // Jika tidak ada supply untuk master_goods_id tersebut
        if (!$supplies) {
            return redirect()->back()->withErrors(['error' => 'Barang tidak ditemukan dalam persediaan.']);
        }

        // Cek apakah jumlah barang cukup
        if ($supplies->remaining_stock < $request->quantity) {
            // Jumlah barang tidak cukup, kembalikan ke layar dengan pesan error
            return redirect()->back()->withErrors(['error' => 'Jumlah barang yang tersedia tidak mencukupi.']);
        }

        // Kurangi jumlah barang
        $supplies->remaining_stock -= $request->quantity;
        $supplies->save();

        $user = $request->user();
        // Simpan data barang keluar
        $out_data = [
            'supplies_id' => $supplies->id,
            'quantity_out' => $request->quantity,
            'operator' => $request->operator,
            'entry_date' => $request->entry_date,
            'user_id' => $user['id'],
        ];
        GoodsOut::create($out_data);

        return redirect()->route('barang_keluar')->with('success', 'Data berhasil ditambahkan.');
    }



    public function edit($id)
    {
        
        
        $outSupply = GoodsOut::with('Supplies.MasterGoods')->where('id', $id)->first();
        $data = array(
            'goods' => Supplies::with('MasterGoods')->orderBy('created_at', 'desc')->get()
        );
        
        return view('halaman.barang-keluar.create_new', compact('data', 'outSupply'), [
            "title" => "Barang Keluar",
            "header" =>  "Barang Keluar",
            "judul" => "DATA BAHAN BAKU"
        ]);


        // $barang_keluar = BarangKeluar::where('id',$id)->first();
        // return view('/halaman/barang-keluar/create',[ 
        //     "title" => "Barang Keluar",
        //     "header" =>  "Barang Keluar",
        //     "judul" => "DATA BAHAN BAKU",
        //     'barang_keluar' => $barang_keluar,
        // ]);
    }

    // public function update($id, Request $request)
    // {
    //     $request->validate([
    //         'kode_barang' => 'required',
    //         'nama_barang' => 'required',
    //         'kategori' => 'required',
    //         'jumlah_keluar' => 'required',
    //         'nama_petugas' => 'required',
    //         'tanggal_keluar' => 'required|date',
    //     ], [
    //         'required' => 'Kolom :attribute harus diisi.',
    //         'date' => 'Kolom :attribute harus berupa tanggal yang valid.',
    //     ]);

    //     $barangKeluar = BarangKeluar::findOrFail($id);

    //     $selisihJumlah = $request->jumlah_keluar - $barangKeluar->jumlah_keluar;

    //     $barang = Barang::where('id',$barangKeluar->id)->first();
    //     if ($barang->jumlah < $request->jumlah_keluar) {
    //         // Jumlah barang tidak cukup, kembalikan ke layar dengan pesan error
    //         return redirect()->back()->withErrors(['error' => 'Jumlah barang yang tersedia tidak mencukupi.']);
    //     }

    //     $barang->jumlah -= $selisihJumlah;
    //     $barang->save();

    //     $data =[
    //         'kode_barang'=>$request->kode_barang,
    //         'nama_barang'=>$request->nama_barang,
    //         'kategori'=>$request->kategori,
    //         'jumlah_keluar'=>$request->jumlah_keluar,
    //         'nama_petugas'=>$request->nama_petugas,
    //         'tanggal_keluar'=>$request->tanggal_keluar,
    //     ];

    //     $barangKeluar->update($data);

    //     return redirect()->route('barang_keluar')->with('success', 'Data berhasil diubah.');
    // }


    public function update($id, Request $request)
    {
        $request->validate([
            'master_goods_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'operator' => 'required',
            'entry_date' => 'required|date',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'date' => 'Kolom :attribute harus berupa tanggal yang valid.',
            'integer' => 'Kolom :attribute harus berupa angka.',
            'min' => 'Kolom :attribute harus minimal :min.',
        ]);

        
        $goodsOut = GoodsOut::findOrFail($id);
        
        $supplies = Supplies::where('id', $goodsOut->supplies_id)->first();
        $currentQuantityOut = $goodsOut->quantity_out;

        // $supplies = Supplies::where('master_goods_id', $request->master_goods_id)->first();
        $newQuantityOut = $request->quantity;
        $difference = $newQuantityOut - $currentQuantityOut;

        // Cek apakah jumlah barang cukup untuk perubahan
        if ($supplies->remaining_stock < $difference) {
            return redirect()->back()->withErrors(['error' => 'Jumlah barang yang tersedia tidak mencukupi.']);
        }

        // Update stok barang
        $supplies->remaining_stock -= $difference;
        $supplies->save();

        // Update data barang keluar
        $goodsOut->update([
            'quantity_out' => $newQuantityOut,
            'operator' => $request->operator,
            'entry_date' => $request->entry_date,
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('barang_keluar')->with('success', 'Data berhasil diubah.');
    }

    public function hapus($id)
    {
        GoodsOut::find($id)->delete();

        return redirect()->route('barang_keluar');
    }
}
