@extends('layouts.main')

@section('contents')
    <div class="col-lg mt-2">
        <div class="card">
            <div class="card-header">
                <p>{{ $title }}</p>
            </div>
            <div class="card-body mt-3">
                <div class=" card-title ms-2">
                    <h5 style="margin-bottom: 20px;">
                        {{ isset($outSupply) ? 'Ubah Data Barang Keluar' : 'Tambah Data Barang Keluar' }}</h5>
                    <h6>Pastikan Diisi Dengan Benar!!</h6>
                </div>
                <div>
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
                    <!-- START FORM -->
                    <form
                        action="{{ isset($outSupply) ? route('barang_keluar.tambah.update', $outSupply->id) : route('barang_keluar.tambah.simpan') }}"
                        method="post" id="formAdd" data-parsley-trigger="">
                        @csrf
                        <div class="my-3 p-3 bg-body rounded shadow-sm">
                            <div class="form-floating mb-3 form-group ">
                                <select class="input-select2 form-control" name="master_goods_id" id="master_goods_id"
                                    required>
                                    <option value="">Pilih Salah Satu</option>
                                    @foreach ($data['goods'] as $barang)
                                        <option value="{{ $barang->MasterGoods->id }}"
                                            @if (isset($outSupply)) {{ $outSupply->Supplies->master_goods_id == $barang->MasterGoods->id ? 'selected' : '' }} @endif>
                                            {{ $barang->MasterGoods->code }} | {{ $barang->MasterGoods->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="floatingInput if_brg">Kode Barang</label>
                            </div>
                            <div class="form-floating mb-3 form-group ">
                                <input type="text" class="form-control" placeholder="Nama Barang" name="name"
                                    id="name" disabled>
                                <label for="floatingInput name">Nama Barang</label>
                            </div>
                            <div class="form-floating mb-3 form-group ">
                                <select class="form-control" name="packaging_type" id="packaging_type" disabled>
                                    <option value="">Pilih Salah Satu</option>
                                    <option value="Bungkus">Bungkus</option>
                                    <option value="Botol">Botol</option>
                                    <option value="Kaleng">Kaleng</option>
                                </select>
                                <label for="floatingInput packaging_type">Kemasan</label>
                            </div>
                            <div class="form-floating mb-3 form-group ">
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                    placeholder="Jumlah" name="quantity" id="quantity"
                                    value="{{ isset($outSupply) ? $outSupply->quantity_out : old('quantity_out') }}"
                                    required>
                                <label for="floatingInput quantity">Jumlah Persediaan</label>
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating mb-3 form-group ">
                                <input type="text" class="form-control" placeholder="Nama Anda" name="operator"
                                    id="operator" value="{{ isset($outSupply) ? $outSupply->operator : old('operator') }}"
                                    required>
                                <label for="floatingInput operator">Nama Anda</label>
                            </div>
                            <div class="form-floating mb-3 form-group ">
                                <input type="date" class="form-control" name="entry_date" id="entry_date"
                                    value="{{ isset($outSupply) ? $outSupply->entry_date : old('entry_date') }}" required>
                                <label for="floatingInput entry_date">Tanggal Masuk</label>
                            </div>
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

    <script type="text/javascript">
        $(document).ready(() => {
            var master_goods_id = $("#master_goods_id").val();
            $.ajax({
                url: `/master-data/${master_goods_id}`,
                type: 'GET',
                success: (res) => {
                    $("#name").val(res.data.name)
                    $("#packaging_type").val(res.data.packaging_type)
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            })
        })

        $("#master_goods_id").change(function() {
            var master_goods_id = $("#master_goods_id").val();
            $.ajax({
                url: `/master-data/${master_goods_id}`,
                type: 'GET',
                success: (res) => {
                    $("#name").val(res.data.name)
                    $("#packaging_type").val(res.data.packaging_type)
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            })
        });
    </script>
@endsection
