@extends('layouts.main')

@section('contents')
    <div class="col-lg mt-2">
        <div class="card">
            <div class="card-header mt-3">
                <div class="card-title ms-2">
                    <h5>Data Master Barang</h5>
                    <div class="d-flex justify-content-end align-items-center">
                        <button type="button" class="btn btn-success btn-sm" id="btnAddData" data-bs-toggle="modal"
                            data-bs-target="#modalAdd"><i class='bi bi-plus-lg'></i>
                            Tambah Data
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered text-nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="bg-light">Kode Barang</th>
                                    <th class="bg-light">Nama Barang</th>
                                    <th class="bg-light">Kemasan</th>
                                    <th class="bg-light">Status</th>
                                    <th class="bg-light">Update</th>
                                    <th class="bg-light">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAdd" data-bs-keyboard="false"
        aria-hidden="true">
        <!-- Scrollable modal -->
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modalTitle">Tambah Data
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="addForm" data-parsley-trigger="input">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-2" id="formCode" style="display: none">
                                <label for="input-text" class="form-label">Kode Barang</label>
                                <input type="text" class="form-control bg-info" readonly name="code" value=""
                                    id="code">
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-2">
                                <label for="input-text" class="form-label">Nama Barang*</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Input Nama Barang" required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="text-area" class="form-label">Kemasan*</label>
                                <select class="form-control" name="packaging_type" id="packaging_type" required>
                                    <option value="">Pilih Salah Satu</option>
                                    <option value="Bungkus">Bungkus</option>
                                    <option value="Botol">Botol</option>
                                    <option value="Kaleng">Kaleng</option>
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <label for="text-area" class="form-label">Status*</label>
                                <select class="form-control" name="active" id="active" required>
                                    <option value="">Pilih Salah Satu</option>
                                    <option value="Y">Aktif</option>
                                    <option value="N">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnSubmit">Save
                        Changes</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(() => {
            loadData();
        })

        const setData = (a, b, c, d) => {
            $('#code').val(a);
            $('#name').val(b);
            $('#packaging_type').val(c);
            $('#packaging_type').trigger('change');
            $('#active').val(d);
            $('#active').trigger('change');
        }
        let status = "tambah";
        let idForEdit;
        let tampungId = 0;

        function loadData() {
            var i = 1;
            $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                bDestroy: true,
                ajax: "{{ route('master-data') }}",
                columnDefs: [{
                    targets: [-1], //last column
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }, {
                    targets: [0, 3, 4], //last column
                    className: "text-center",
                }, ],
                columns: [{
                        data: 'code',
                        name: 'code',
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'packaging_type',
                        name: 'packaging_type',
                    },
                    {
                        data: 'active',
                        name: 'active',
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ],
            });
        }

        $('#btnAddData').click(() => {
            setData("", "", "", "")
            $('#modalTitle').html('Tambah Data')
            $('#formCode').hide();
            status = "tambah";
        })

        function insertData() {
            $('#addForm').parsley().validate();
            if ($('#addForm').parsley().isValid()) {
                $.ajax({
                    url: "{{ route('master-data.insert') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $('#addForm').serialize(),
                    success: (res) => {
                        swalert(res.status, res.message);
                        $('#modalAdd').modal('hide')
                        loadData();
                        setData("", "", "", "");
                    },
                    error: (err) => {
                        console.log(err);
                    }
                })
            }
        }

        function editData(id) {
            $('#modalAdd').modal('show');
            $('#formCode').show();
            idForEdit = id
            status = "edit";
            $('#modalTitle').html('Edit Data')
            $.ajax({
                url: `/master-data/${id}`,
                type: 'GET',
                success: (res) => {
                    let data = res.data
                    setData(data.code, data.name, data.packaging_type, data.active)
                },
                error: (err) => {
                    console.log(err)
                }
            })
        }

        function updateData() {

            $('#addForm').parsley().validate();
            if ($('#addForm').parsley().isValid()) {
                $.ajax({
                    url: `/master-data/update/${idForEdit}`,
                    type: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $('#addForm').serialize(),
                    success: (res) => {
                        swalert(res.status, res.message);
                        $('#modalAdd').modal('hide')
                        loadData();
                        setData("", "", "");
                    },
                    error: (err) => {
                        console.log(err);
                    }
                })
            }
        }

        $('#btnSubmit').click((e) => {
            e.preventDefault();
            if (status === "tambah") {
                insertData()
            } else {
                updateData()
            }
        })
    </script>
@endsection
