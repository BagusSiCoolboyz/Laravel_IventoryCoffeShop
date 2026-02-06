<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\IncomingGoods;
use Illuminate\Http\Request;

class LaporanMasukController extends Controller
{
    public function index()
    {
        $barangMasuk = IncomingGoods::with('Supplies.MasterGoods')->orderBy('created_at', 'desc')->get();

        return view('halaman.laporan.masuk', [
            'title' => 'Laporan Masuk',
            'header' => 'Laporan Masuk',
            'judul' => 'DATA BAHAN BAKU',
            'data' => $barangMasuk
        ]);
    }
    // public function tambah()
    // {
    //     // return view('/halaman/barang-masuk/create');
    // }

    // public function simpan(Request $request)
    // {
    //     $request->validate([
    //         'id_brg' => 'required',
    //         'nama_brg' => 'required',
    //         'kategori' => 'required',
    //         'jumlah_masuk' => 'required',
    //         'nama_masuk' => 'required',
    //         'tgl_masuk' => 'required|date',
    //     ], [
    //         'required' => 'Kolom :attribute harus diisi.',
    //         'date' => 'Kolom :attribute harus berupa tanggal yang valid.',
    //     ]);

    //     $data =[
    //         'id_brg'=>$request->id_brg,
    //         'nama_brg'=>$request->nama_brg,
    //         'kategori'=>$request->kategori,
    //         'jumlah_masuk'=>$request->jumlah_masuk,
    //         'nama_masuk'=>$request->nama_masuk,
    //         'tgl_masuk'=>$request->tgl_masuk,
    //     ];

    //     BarangMasuk::create($data);
    //     return redirect()->route('laporan-masuk')->with('success', 'Data berhasil ditambahkan.');
    // }

    // public function edit($id)
    // {
    //     // $barang_masuk = BarangMasuk::where('id',$id)->first();
    //     // return view('/halaman/barang-masuk/create',[ 
    //     //     "title" => "Barang Masuk",
    //     //     "header" =>  "Barang Masuk",
    //     //     "judul" => "DATA BAHAN BAKU",
    //     //     'barang_masuk' => $barang_masuk,
    //     // ]);
    // }

    // public function update($id, Request $request)
    // {
    //     $request->validate([
    //         'id_brg' => 'required',
    //         'nama_brg' => 'required',
    //         'kategori' => 'required',
    //         'jumlah_masuk' => 'required',
    //         'nama_masuk' => 'required',
    //         'tgl_masuk' => 'required|date',
    //     ], [
    //         'required' => 'Kolom :attribute harus diisi.',
    //         'date' => 'Kolom :attribute harus berupa tanggal yang valid.',
    //     ]);

    //     $data =[
    //         'id_brg'=>$request->id_brg,
    //         'nama_brg'=>$request->nama_brg,
    //         'kategori'=>$request->kategori,
    //         'jumlah_masuk'=>$request->jumlah_masuk,
    //         'nama_masuk'=>$request->nama_masuk,
    //         'tgl_masuk'=>$request->tgl_masuk,
    //     ];

    //     BarangMasuk::find($id)->update($data);

    //     return redirect()->route('laporan-masuk')->with('success', 'Data berhasil diubah.');
    // }

    // public function hapus($id)
    // {
    //     BarangMasuk::find($id)->delete();

    //     return redirect()->route('laporan-masuk');
    // }
}
