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
                    <a href="{{ route('barang_keluar/create') }}" class="btn btn-success bi bi-plus-lg me-2">
                        Tambah Data
                    </a>
                </div>
            </div>
            <div class="card table-responsive ms-3 me-3 mt-2 mb-4">
                <table id="myTable" class="table table-striped table-hover">
                    <thead class="thead-dark table-primary">
                        <tr>
                            <th>#</th>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($no = ($data->currentPage() - 1) * $data->perPage() + 1)
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->kode_barang }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td>{{ $item->jumlah_keluar }}</td>
                                <td>
                                    <div style="display: flex; align-items: center;">
                                        @if (auth()->check() && auth()->user()->email === 'admin@gmail.com')
                                            <a href="{{ route('barang_keluar.edit', $item->id) }}"
                                                class="btn btn-warning bi bi-pencil-square me-1"></a>
                                        @endif
                                        <form action="{{ route('barang_keluar.hapus', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin Menghapus Data?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger bi bi-trash"></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-custom d-flex-end justify-content me-3 ms-3">
                {{ $data->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
