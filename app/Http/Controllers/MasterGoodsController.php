<?php

namespace App\Http\Controllers;

use App\Models\MasterGoods;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

// DATA MASTER BARANG
class MasterGoodsController extends Controller
{

    public function list(Request $request)
    {
        $data = array(
            'title' => 'Data Master',
            'navBar' => 'Divisi'
        );
        $getData = MasterGoods::latest()->get();
        if ($request->ajax()) {
            return DataTables::of($getData)
                ->addColumn('active', function ($getData) {
                    return $getData->active === 'Y' ? '<b class="text-success">Aktif</b>' : '<b class="text-danger">Tidak Aktif</b>';
                })
                ->addColumn('updated_at', function ($row) {
                    return date('d M Y H:i', strtotime($row->updated_at));
                })
                ->addColumn('action', function ($getData) {
                    return '<button onClick="editData(' . $getData->id . ')"title="Edit" class="btn btn-warning btn-sm bi bi-pencil-square"> </button> ';
                })
                ->rawColumns(['action', 'active'])
                ->make(true);
        }
        return view('master-data.goods', compact('request', 'data'), [
            "title" => "Data Master",
            "header" =>  "Barang",
            "judul" => "DATA BAHAN BAKU",
        ]);

        $data = MasterGoods::latest()->get();
    }

    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'name' => 'required',
                'packaging_type' => 'required',
                'active' => 'required'
            ]);

            $user = $request->user();
            $validate['user_id'] = $user['id'];
            $validate['code'] = Str::upper(Str::random(8));

            if (MasterGoods::where('name', '=', $request->name)->exists()) {
                return response()->json([
                    'status' => 'warning',
                    'message' => 'Nama sudah tersedia di database!',
                ]);
            } else {
                MasterGoods::create($validate);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil ditambahkan!',
                    'data' => $validate
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => "disini ? " . $e->getMessage()
            ]);
        }
    }

    public function showData($id)
    {
        $data = MasterGoods::where('id', $id)->first();
        try {
            return response()->json([
                'status' => 'success',
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'data' => $e->getMessage()
            ]);
        }
    }

    public function updateData(Request $request, $id)
    {
        try {
            $validate = $request->validate([
                'name' => 'required',
                'packaging_type' => 'required',
                'active' => 'required'
            ]);
            $user = $request->user();
            $validate['user_id'] = $user['id'];

            MasterGoods::where('id', $id)->update($validate);
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mengubah data',
                'data' => $validate
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
