@extends('layouts.main')

@section('contents')
    <div class="col-lg mt-2">
        <div class="card">
            <div class="card-header">
                {{ $header }}
            </div>
            <div class="card-body mt-3">
                <div class="card-title ms-2">
                    <h5 style="margin-bottom: 20px;">Laporan Barang Masuk</h5>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <form>
                        <div class="me-2" style="display: flex; gap: 16px;">
                            <div>
                                <label for="tgl_mulai" class="form-label">Periode</label>
                                <div class="d-flex align-items-center">
                                    <input type="date" class="form-control form-control-date me-2" id="tgl_mulai"
                                        style="width: 150px;">
                                    <span>s/d</span>
                                    <input type="date" class="form-control form-control-date ms-2" id="tgl_selesai"
                                        style="width: 150px;">
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="button" class="btn btn-primary mt-4 bi bi-funnel"
                                    id="filterButton">Filter</button>
                            </div>
                        </div>
                    </form>

                    <div class="me-2" style="display: flex; gap: 16px;">
                        <div class="mt-2">
                            <button class="btn btn-success bi bi-file-earmark-arrow-down mt-4 ms-4" type="button"
                                id="downloadButton">
                                Export To Excel</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card table-responsive ms-3 me-3 mt-2 mb-4">
                <table id="dataTable" class="table table-lg table-striped table-hover">
                    <thead class="thead-dark table-primary">
                        <tr>
                            <td><b>Nomor</b></td>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kemasan</th>
                            <th>Jumlah</th>
                            <th>Petugas</th>
                            <th>Tanggal Masuk</th>
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
                                <td>{{ $item->quantity_in }}</td>
                                <td>{{ $item->operator }}</td>
                                <td>{{ date('d M Y', strtotime($item->entry_date)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- SheetJS (xlsx) library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <script>
        document.getElementById('downloadButton').addEventListener('click', function() {
            var wb = XLSX.utils.table_to_book(document.getElementById('dataTable'), {
                sheet: "Sheet1"
            });

            // Adjust column width
            var ws = wb.Sheets["Sheet1"];
            var wscols = [
                { wch: 5 },   // Nomor
                { wch: 15 },  // Kode Barang
                { wch: 20 },  // Nama Barang
                { wch: 20 },  // Kategori
                { wch: 10 },  // Jumlah
                { wch: 15 },  // Petugas
                { wch: 15 }   // Tanggal Masuk
            ];
            ws['!cols'] = wscols;

            XLSX.writeFile(wb, 'Laporan_Barang_Masuk.xlsx');
        });

        document.getElementById('filterButton').addEventListener('click', function() {
            var startDate = document.getElementById('tgl_mulai').value;
            var endDate = document.getElementById('tgl_selesai').value;

            var tableRows = document.getElementById('dataTable').querySelectorAll('tbody tr');
            tableRows.forEach(function(row) {
                var tanggalMasuk = row.cells[6].innerText;
                var tanggalMasukDate = new Date(tanggalMasuk.split(' ').reverse().join('-'));

                var formattedTanggalMasuk = tanggalMasukDate.toISOString().slice(0, 10);

                if (formattedTanggalMasuk >= startDate && formattedTanggalMasuk <= endDate) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection
