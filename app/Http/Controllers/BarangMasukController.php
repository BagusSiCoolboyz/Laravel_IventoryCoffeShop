<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\BarangMasuk;
use App\Models\IncomingGoods;
use App\Models\MasterGoods;
use App\Models\Supplies;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
{
    // public function index()
    // {
    //     $barang_masuk = BarangMasuk::orderBy('created_at', 'desc')->paginate(5);

    //     return view('halaman/barang-masuk/barang_masuk_new', [
    //         "title" => "Barang Masuk",
    //         "header" =>  "Barang Masuk",
    //         "judul" => "DATA BAHAN BAKU",
    //         'data' => $barang_masuk

    //     ]);
    // }

    public function index()
    {
        $barang_masuk = IncomingGoods::with('Supplies.MasterGoods')->orderBy('created_at', 'desc')->get();

        return view('halaman.barang-masuk.barang_masuk_new', [
            "title" => "Barang Masuk",
            "header" =>  "Barang Masuk",
            "judul" => "DATA BAHAN BAKU",
            'data' => $barang_masuk
        ]);
    }

    // public function tambah()
    // {
    //     return view('/halaman/barang-masuk/create');
    // }

    public function tambah()
    {
        $data = array(
            'goods' => MasterGoods::where('active', 'Y')->get()
        );
        return view('halaman.barang-masuk.create_new', compact('data'), [
            "title" => "Barang Masuk",
            "header" =>  "Barang Masuk",
            "judul" => "DATA BAHAN BAKU"
        ]);
    }

    // public function simpan(Request $request)
    // {
    //     // dd($request);
    //     $request->validate([
    //         'kode_barang' => 'required',
    //         'nama_barang' => 'required',
    //         'kategori' => 'required',
    //         'jumlah_masuk' => 'required|integer',
    //         'nama_petugas' => 'required',
    //         'tanggal_masuk' => 'required|date',
    //     ], [
    //         'required' => 'Kolom :attribute harus diisi.',
    //         'date' => 'Kolom :attribute harus berupa tanggal yang valid.',
    //         'integer' => 'Kolom :attribute harus berupa angka.',
    //     ]);

    //     // Pengecekan apakah barang sudah ada
    //     $barang = barang::where('kode_barang', $request->kode_barang)
    //         ->where('nama_barang', $request->nama_barang)
    //         ->first();

    //     if ($barang) {
    //         // Jika barang sudah ada, tambahkan jumlahnya
    //         $barang->jumlah += $request->jumlah_masuk;
    //         $barang->save();
    //     } else {
    //         // Jika barang belum ada, tambahkan barang baru
    //         $data_barang = [
    //             'kode_barang' => $request->kode_barang,
    //             'nama_barang' => $request->nama_barang,
    //             'kategori' => $request->kategori,
    //             'jumlah' => $request->jumlah_masuk,
    //         ];
    //         barang::create($data_barang);
    //     }

    //     // Tambahkan data ke tabel BarangMasuk
    //     $data_laporan = [
    //         'kode_barang' => $request->kode_barang,
    //         'nama_barang' => $request->nama_barang,
    //         'kategori' => $request->kategori,
    //         'jumlah_masuk' => $request->jumlah_masuk,
    //         'nama_petugas' => $request->nama_petugas,
    //         'tanggal_masuk' => $request->tanggal_masuk,
    //     ];
    //     BarangMasuk::create($data_laporan);

    //     return redirect()->route('barang_masuk')->with('success', 'Data berhasil ditambahkan.');
    // }

    public function simpan(Request $request)
    {
        $request->validate([
            'master_goods_id' => 'required',
            'quantity' => 'required|integer',
            'operator' => 'required|regex:/^[a-zA-Z\s]+$/',
            'entry_date' => 'required|date',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'date' => 'Kolom :attribute harus berupa tanggal yang valid.',
            'integer' => 'Kolom :attribute harus berupa angka.',
            'regex' => 'Nama anda hanya boleh berisi huruf.'
        ]);

        $supplies = Supplies::where('master_goods_id', $request->master_goods_id)->first();

        $user = $request->user();
        $quantityToAdd = $request->quantity;

        // Jika supplies sudah ada, tambahkan jumlahnya
        if ($supplies) {
            // Hitung jumlah total setelah penambahan
            $newQuantity = $supplies->quantity + $quantityToAdd;

            // Cek apakah jumlah baru melebihi 100
            if ($newQuantity > 5000) {
                return redirect()->back()->withErrors('Jumlah barang tidak boleh melebihi 5000.');
            }

            $supplies->quantity = $newQuantity;
            $supplies->remaining_stock += $quantityToAdd;
            $supplies->save();

            $incoming_data = [
                'supplies_id' => $supplies->id,
                'quantity_in' => $quantityToAdd,
                'operator' => $request->operator,
                'entry_date' => $request->entry_date,
                'user_id' =>  $user['id'],
            ];
            IncomingGoods::create($incoming_data);
        } else {
            // Jika barang belum ada, cek apakah jumlah yang ditambahkan melebihi 100
            if ($quantityToAdd > 5000) {
                return redirect()->back()->withErrors('Jumlah barang tidak boleh melebihi 5000.');
            }

            $data_supply = [
                'master_goods_id' => $request->master_goods_id,
                'quantity' => $quantityToAdd,
                'remaining_stock' => $quantityToAdd,
                'user_id' =>  $user['id'],
            ];
            $create = Supplies::create($data_supply);

            if ($create) {
                $suppliesNew = Supplies::where('master_goods_id', $request->master_goods_id)->first();

                $incoming_data = [
                    'supplies_id' => $suppliesNew->id,
                    'quantity_in' => $quantityToAdd,
                    'operator' => $request->operator,
                    'entry_date' => $request->entry_date,
                    'user_id' =>  $user['id'],
                ];
                IncomingGoods::create($incoming_data);
            }
        }

        return redirect()->route('barang_masuk')->with('success', 'Data berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $incomingSupply = IncomingGoods::with('Supplies.MasterGoods')->where('id', $id)->first();
        $data = array(
            'goods' => MasterGoods::where('active', 'Y')->get()
        );
        return view('halaman.barang-masuk.create_new', compact('data', 'incomingSupply'), [
            "title" => "Barang Masuk",
            "header" =>  "Barang Masuk",
            "judul" => "DATA BAHAN BAKU"
        ]);
    }

    // public function update($id, Request $request)
    // {
    //     //dd($request);
    //     $request->validate([
    //         'kode_barang' => 'required',
    //         'nama_barang' => 'required',
    //         'kategori' => 'required',
    //         'jumlah_masuk' => 'required',
    //         'nama_petugas' => 'required',
    //         'tanggal_masuk' => 'required|date',
    //     ], [
    //         'required' => 'Kolom :attribute harus diisi.',
    //         'date' => 'Kolom :attribute harus berupa tanggal yang valid.',
    //     ]);

    //     // Mengambil data barang masuk yang akan diupdate
    //     $barangMasuk = BarangMasuk::findOrFail($id);

    //     // Menghitung selisih jumlah masuk baru dengan jumlah masuk lama
    //     $selisihJumlah = $request->jumlah_masuk - $barangMasuk->jumlah_masuk;

    //     // Menambahkan selisih jumlah masuk ke jumlah barang di tabel barang
    //     $barang = Barang::where('id', $barangMasuk->id)->first();
    //     $barang->jumlah += $selisihJumlah;
    //     $barang->save();

    //     // Memperbarui data barang masuk
    //     $data = [
    //         'kode_barang' => $request->kode_barang,
    //         'nama_barang' => $request->nama_barang,
    //         'kategori' => $request->kategori,
    //         'jumlah_masuk' => $request->jumlah_masuk,
    //         'nama_petugas' => $request->nama_petugas,
    //         'tanggal_masuk' => $request->tanggal_masuk,
    //     ];

    //     $barangMasuk->update($data);

    //     return redirect()->route('barang_masuk')->with('success', 'Data berhasil diubah.');
    // }

    public function update($id, Request $request)
    {
        $request->validate([
            'master_goods_id' => 'required',
            'quantity' => 'required|integer',
            'operator' => 'required|regex:/^[a-zA-Z\s]+$/',
            'entry_date' => 'required|date',
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'date' => 'Kolom :attribute harus berupa tanggal yang valid.',
            'integer' => 'Kolom :attribute harus berupa angka.',
            'regex' => 'Nama anda hanya boleh berisi huruf.'
        ]);

        $barangMasuk = IncomingGoods::findOrFail($id);
        $quantityToAdd = $request->quantity;
        $selisihJumlah = $quantityToAdd - $barangMasuk->quantity_in;

        $supplies = Supplies::where('id', $barangMasuk->supplies_id)->first();
        $newQuantity = $supplies->quantity + $selisihJumlah;

        // Cek apakah jumlah baru melebihi 100
        if ($newQuantity > 100) {
            return redirect()->back()->withErrors('Jumlah barang tidak boleh melebihi 100.');
        }

        $supplies->quantity = $newQuantity;
        $supplies->save();

        $user = $request->user();
        $incoming_data = [
            'quantity_in' => $quantityToAdd,
            'operator' => $request->operator,
            'entry_date' => $request->entry_date,
            'user_id' =>  $user['id'],
        ];

        $barangMasuk->update($incoming_data);

        return redirect()->route('barang_masuk')->with('success', 'Data berhasil diUpdate.');
    }



    public function hapus($id)
    {
        IncomingGoods::find($id)->delete();

        return redirect()->route('barang_masuk');
    }


    // public function filterByDate(Request $request)
    // {
    //     $tglMulai = $request->tgl_mulai;
    //     $tglSelesai = $request->tgl_selesai;

    //     // Query untuk mengambil data berdasarkan rentang tanggal
    //     $data = BarangMasuk::whereBetween('tanggal_masuk', [$tglMulai, $tglSelesai])
    //         ->orderBy('tanggal_masuk', 'desc')
    //         ->get();

    //     // Kembalikan view partial untuk mengganti data tabel
    //     return view('partials.data_table', compact('data'));
    // }
}
