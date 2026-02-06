@extends('layouts.main')

@section('contents')
    <div class="col-lg mt-2">
        <div class="card">
            <div class="card-header">
                {{ $header }}
            </div>
            <div class="card-body mt-3">
                <div class="card-title ms-2">
                    <h5 style="margin-bottom: 20px;">Persediaan Barang</h5>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    @if (Auth::user() && Auth::user()->role == 'admin')
                        <div class="me-2" style="display: flex; gap: 16px;">
                            <div class="mt-2">
                                <button class="btn btn-success bi bi-file-earmark-arrow-down mt-4 ms-4" type="button"
                                    id="downloadButton">
                                    Export To Excel</button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card table-responsive ms-3 me-3 mt-2 mb-4">
                <table class="table table-lg table-striped table-hover" id="myTable">
                    <thead class="thead-dark table-primary">
                        <tr>
                            <th>#</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kemasan</th>
                            <th>Stock Awal</th>
                            <th>Sisa Stock</th>
                            <th>Update</th>
                            <th>Status</th>
                            {{-- @if (Auth::user() && Auth::user()->role == 'admin')
                                <th>Action</th>
                            @endif --}}
                        </tr>
                    </thead>
                    <tbody>
                        @php($no = 1)
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->MasterGoods->code }}</td>
                                <td>{{ $item->MasterGoods->name }}</td>
                                <td>{{ $item->MasterGoods->packaging_type }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->remaining_stock }}</td>
                                <td>{{ date('d M Y H:i', strtotime($item->updated_at)) }}</td>
                                <td>
                                    @if ($item->remaining_stock < 10)
                                        <!-- Ambang batas stok menipis -->
                                        <span class="text-danger fw-bold border border-danger rounded p-1">Menipis</span>
                                    @else
                                        <span class="text-success fw-bold border border-success rounded p-1">Aman</span>
                                    @endif
                                </td>
                                {{-- @if (Auth::user() && Auth::user()->role == 'admin')
                                    <td>
                                        <form action="{{ route('persediaan.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin Menghapus Data?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger bi bi-trash"></button>
                                        </form>
                                    </td>
                                @endif --}}
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
        @if (Auth::user() && Auth::user()->role == 'admin')
            document.getElementById('downloadButton').addEventListener('click', function() {
                var wb = XLSX.utils.table_to_book(document.getElementById('myTable'), {
                    sheet: "Sheet1"
                });

                var ws = wb.Sheets["Sheet1"];
                var range = XLSX.utils.decode_range(ws['!ref']);

                // Set column width to ensure dates are fully visible
                if (!ws['!cols']) ws['!cols'] = [];
                ws['!cols'][6] = {
                    wch: 20
                };

                for (var R = range.s.r; R <= range.e.r; ++R) {
                    for (var C = range.s.c; C <= range.e.c; ++C) {
                        var cell_address = XLSX.utils.encode_cell({
                            r: R,
                            c: C
                        });
                        if (!ws[cell_address]) continue;

                        if (R === 0) {
                            ws[cell_address].s = {
                                border: {
                                    top: {
                                        style: "thin",
                                        color: {
                                            rgb: "000000"
                                        }
                                    },
                                    bottom: {
                                        style: "thin",
                                        color: {
                                            rgb: "000000"
                                        }
                                    },
                                    left: {
                                        style: "thin",
                                        color: {
                                            rgb: "000000"
                                        }
                                    },
                                    right: {
                                        style: "thin",
                                        color: {
                                            rgb: "000000"
                                        }
                                    }
                                }
                            };
                        } else if (C === 6) {
                            ws[cell_address].z = 'dd mmm yyyy hh:mm';
                        }
                    }
                }

                XLSX.writeFile(wb, 'Laporan_Persediaan.xlsx');
            });
        @endif

        // Add event listener to search form
        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            var searchText = document.getElementById('searchInput').value.toLowerCase();

            // Loop through each row and show/hide based on search text
            var tableRows = document.getElementById('myTable').querySelectorAll('tbody tr');
            tableRows.forEach(function(row) {
                var rowText = row.innerText.toLowerCase(); // Get entire row text

                if (rowText.includes(searchText)) {
                    row.style.display = ''; // Show row if the text matches the searchText
                } else {
                    row.style.display = 'none'; // Hide row if the text does not match the searchText
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            let rows = document.querySelectorAll('#myTable tbody tr');

            rows.forEach(function(row) {
                let remainingStock = parseInt(row.children[5]
                    .innerText); // Ambil nilai sisa stok dari kolom ke-6
                if (remainingStock < 10) { // Ambang batas stok menipis
                    alert(`Barang "${row.children[2].innerText}" menipis! Sisa stok: ${remainingStock}`);
                }
            });
        });

        

        // Add event listener to delete buttons
        @if (Auth::user() && Auth::user()->role == 'admin')
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    if (confirm('Apakah yakin menghapus data?')) {
                        this.closest('form').submit();
                    }
                });
            });
        @endif
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if ($stokMenipis)
                Swal.fire({
                    title: 'Peringatan!',
                    text: 'Terdapat persediaan barang dengan stok menipis!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>    
@endsection
