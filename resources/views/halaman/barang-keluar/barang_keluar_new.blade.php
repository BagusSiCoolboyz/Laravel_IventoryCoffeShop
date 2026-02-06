@extends('layouts.main')

@section('contents')
    <div class="col-lg mt-2">
        <div class="card">
            <div class="card-header">
                {{ $header }}
            </div>
            <div class="card-body mt-3">
                <div class=" card-title ms-2">
                    <h5 style="margin-bottom: 20px;">Data Barang Keluar</h5>
                </div>
                <div class="d-flex justify-content-end align-items-center mt-2">
                    <a href="{{ route('barang_keluar.tambah') }}" class="btn btn-success bi bi-plus-lg me-2">
                        Tambah Data
                    </a>
                </div>
            </div>
            <div class="card table-responsive ms-3 me-3 mt-2 mb-4">
                <table id="myTable" class="table table-striped table-hover">
                    <thead class="thead-dark table-primary">
                        <tr>
                            <th>#</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kemasan</th>
                            <th>Jumlah</th>
                            <th>Operator</th>
                            <th>Tanggal Keluar</th>
                            @if (auth()->check() && auth()->user()->role == 'admin')
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($no = 1)
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->Supplies->MasterGoods->code }}</td>
                                <td>{{ $item->Supplies->MasterGoods->name }}</td>
                                <td>{{ $item->Supplies->MasterGoods->packaging_type }}</td>
                                <td>{{ $item->quantity_out }}</td>
                                <td>{{ $item->operator }}</td>
                                <td>{{ date('d M Y', strtotime($item->entry_date)) }}</td>
                                @if (auth()->check() && auth()->user()->role == 'admin')
                                    <td>
                                        <div style="display: flex; align-items: center;">
                                            <a href="{{ route('barang_keluar.edit', $item->id) }}"
                                                class="btn btn-warning bi bi-pencil-square me-1"></a>
                                            <form action="{{ route('barang_keluar.hapus', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin Menghapus Data?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger bi bi-trash"></button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
