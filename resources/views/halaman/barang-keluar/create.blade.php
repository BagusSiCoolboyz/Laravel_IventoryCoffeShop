@extends('layouts.main')

@section('contents')
    <div class="col-lg mt-2">
        <div class="card">
            <div class="card-header">
                <p>Tambah Data</p>
            </div>
            <div class="card-body mt-3">
                <div class="card-title ms-2">
                    <h5 style="margin-bottom: 20px;">{{ isset($barang_keluar) ? 'Rubah Data Barang Keluar' : 'Tambah Data Barang Keluar' }}</h5>
                </div>
                <div>
                    <!-- START FORM -->
                    <form action="{{ isset($barang_keluar) ? route('barang_keluar.tambah.update', $barang_keluar->id) : route('barang_keluar.tambah.simpan') }}" method="post">
                        @csrf
                        <div class="my-3 p-3 bg-body rounded shadow-sm">
                            <!-- Kode Barang -->
                                                        <!-- Error Messages -->
                                                        @if ($errors->any())
                                                        <div class="alert alert-danger">
                                                            <ul>
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                            <div class="form-floating mb-3 form-group">
                                <input type="text" class="form-control @error('kode_barang') is-invalid @enderror" id="kode_barang" placeholder="ID Barang" name="kode_barang" value="{{ isset($barang_keluar) ? $barang_keluar->kode_barang : old('kode_barang') }}">
                                <label for="kode_barang">Kode Barang</label>
                                @error('kode_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Nama Barang -->
                            <div class="form-floating mb-3 form-group">
                                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" placeholder="Nama Barang" name="nama_barang" value="{{ isset($barang_keluar) ? $barang_keluar->nama_barang : old('nama_barang') }}">
                                <label for="nama_barang">Nama Barang</label>
                                @error('nama_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Kategori -->
                            <div class="form-floating mb-3 form-group">
                                <input type="text" class="form-control @error('kategori') is-invalid @enderror" id="kategori" placeholder="Kategori" name="kategori" value="{{ isset($barang_keluar) ? $barang_keluar->kategori : old('kategori') }}">
                                <label for="kategori">Kategori</label>
                                @error('kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Jumlah Keluar -->
                            <div class="form-floating mb-3 form-group">
                                <input type="number" class="form-control @error('jumlah_keluar') is-invalid @enderror" id="jumlah_keluar" placeholder="Jumlah" name="jumlah_keluar" value="{{ isset($barang_keluar) ? $barang_keluar->jumlah_keluar : old('jumlah_keluar') }}">
                                <label for="jumlah_keluar">Jumlah Keluar</label>
                                @error('jumlah_keluar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Nama Petugas -->
                            <div class="form-floating mb-3 form-group">
                                <input type="text" class="form-control @error('nama_petugas') is-invalid @enderror" id="nama_petugas" placeholder="Nama Anda" name="nama_petugas" value="{{ isset($barang_keluar) ? $barang_keluar->nama_petugas : old('nama_petugas') }}">
                                <label for="nama_petugas">Nama Anda</label>
                                @error('nama_petugas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Tanggal Keluar -->
                            <div class="form-floating mb-3 form-group">
                                <input type="date" class="form-control @error('tanggal_keluar') is-invalid @enderror" id="tanggal_keluar" name="tanggal_keluar" value="{{ isset($barang_keluar) ? $barang_keluar->tanggal_keluar : old('tanggal_keluar') }}">
                                <label for="tanggal_keluar">Tanggal Keluar</label>
                                @error('tanggal_keluar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Tombol Simpan dan Kembali -->
                            <div class="mb-3 row">
                                <label for="tambah" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                                    <a href="{{ route('barang_keluar') }}" class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- AKHIR FORM -->
                </div>
            </div>
        </div>
    </div>
@endsection
