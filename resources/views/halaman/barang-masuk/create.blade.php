{{-- @extends('layouts.main')

@section('contents')
    <div class="col-lg mt-2">
        <div class="card">
            <div class="card-header">
                <p>{{ $title }}</p>
            </div>
            <div class="card-body mt-3">
                <div class=" card-title ms-2">
                    <h5 style="margin-bottom: 20px;">{{ isset($barang_masuk)?'Rubah Data Barang Masuk': 'Tambah Data Barang Masuk' }}</h5>
                    <p>Pastikan Diisi Dengan Benar!!</p>
                </div>
                <div>
                    <!-- START FORM -->
                    <form action="{{ isset($barang_masuk) ? route('barang_masuk.tambah.update',$barang_masuk->id): route('barang_masuk.tambah.simpan') }}"  method="post">
                        @csrf
                        <div class="my-3 p-3 bg-body rounded shadow-sm">
                            <div class="form-floating mb-3 form-group ">
                                <input type="text" class="form-control" id="floatingInput" placeholder="ID Barang"
                                    name="kode_barang" id="kode_barang" value="{{ isset($barang_masuk) ? $barang_masuk->kode_barang : old('kode_barang') }}">
                                <label for="floatingInput if_brg">Kode Barang</label>
                            </div>
                            <div class="form-floating mb-3 form-group ">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Nama Barang"
                                    name="nama_barang" id="nama_barang" value="{{ isset($barang_masuk) ? $barang_masuk->nama_barang : old('nama_barang') }}">
                                <label for="floatingInput nama_barang">Nama Barang</label>
                            </div>
                            <div class="form-floating mb-3 form-group ">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Kategori"
                                    name="kategori"
                                    id="kategori" value="{{ isset($barang_masuk) ? $barang_masuk->kategori : old('kategori') }}">
                                <label for="floatingInput kategori">Kategori</label>
                            </div>
                            <div class="form-floating mb-3 form-group ">
                                <input type="number" class="form-control" id="floatingInput" placeholder="Jumlah"
                                    name="jumlah_masuk" id="jumlah_masuk"
                                    value="{{ isset($barang_masuk) ? $barang_masuk->jumlah_masuk : old('jumlah_masuk') }}">
                                <label for="floatingInput jumlah_masuk">Jumlah</label>
                            </div>
                            <div class="form-floating mb-3 form-group ">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Nama Anda"
                                    name="nama_petugas" id="nama_petugas"
                                    value="{{ isset($barang_masuk) ? $barang_masuk->nama_petugas : old('nama_petugas') }}">
                                <label for="floatingInput nama_petugas">Nama Anda</label>
                            </div>
                            <div class="form-floating mb-3 form-group ">
                                <input type="date" class="form-control" id="floatingInput" name="tanggal_masuk"
                                    id="tanggal_masuk"value="{{ isset($barang_masuk) ? $barang_masuk->tanggal_masuk : old('tanggal_masuk') }}">
                                <label for="floatingInput tanggal_masuk">Tanggal Masuk</label>
                            </div>
                            <div class="mb-3 row">
                                <label for="tambah" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                                    <a href="{{ route('barang_masuk') }}" class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- AKHIR FORM -->

                </div>
            </div>
        </div>
    </div>
@endsection --}}
