<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\Supplies;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PersediaanController extends Controller
{
    // public function index(Request $request)
    // {
    //     $perPage = 5;
    //     $page = $request->input('page', 1);
    //     $offset = ($page - 1) * $perPage;

    //     // Gabungkan data barang masuk dan keluar
    //     $persediaan = barang::all()->sortByDesc('tanggal');

    //     // Buat LengthAwarePaginator instance setelah penggabungan data
    //     $currentPageItems = $persediaan->slice($offset, $perPage)->all();
    //     $paginatedItems = new LengthAwarePaginator(
    //         $currentPageItems,
    //         $persediaan->count(),
    //         $perPage,
    //         $page,
    //         ['path' => $request->url(), 'query' => $request->query()]
    //     );

    //     return view('/halaman/persediaan', [
    //         "title" => "Persediaan",
    //         "header" =>  "Persediaan",
    //         "judul" => "DATA BAHAN BAKU",
    //         'persediaan' => $paginatedItems
    //     ]);
    // }

    public function index()
    {
        $supply = Supplies::with('MasterGoods')->orderBy('created_at', 'desc')->get()
            ->map(function ($item) {
                $item->status = $item->remaining_stock < 10 ? 'Menipis' : 'Aman';
                return $item;
            });

        // Periksa apakah ada barang dengan stok menipis
        $stokMenipis = $supply->where('remaining_stock', '<', 10)->count() > 0;

        return view('halaman.persediaan_new', [
            "title" => "Persediaan",
            "header" =>  "Persediaan",
            "judul" => "DATA BAHAN BAKU",
            'data' => $supply,
            'stokMenipis' => $stokMenipis, // Kirim informasi stok menipis ke view
        ],);

        dd($stokMenipis);
    }

    // public function destroy($id)
    // {
    //     Supplies::find($id)->delete();
    //     return redirect()->route('persediaan');
    // }

    // public function destroy($id)
    // {
    //     $barang = barang::find($id);
    //     if ($barang) {
    //         $barang->delete();
    //         return redirect()->back();
    //     }

    //     return response()->json(['message' => 'Item not found'], 404);
    // }
}
