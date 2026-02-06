{{-- @extends('layouts.main')

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
                    <form class="d-flex mt-4" role="search" id="searchForm">
                        <input class="form-control me-2" type="search" placeholder="Cari Nama Barang" aria-label="Search"
                            id="searchInput">
                        <button class="btn btn-outline-success" type="submit">Cari</button>
                    </form>
                    @if (Auth::user() && Auth::user()->role == 'admin')
                        <div class="me-2" style="display: flex; gap: 16px;">
                            <div class="mt-2">
                                <button class="btn btn-success bi bi-file-earmark-arrow-down mt-4 ms-4" type="button"
                                    id="downloadButton">
                                    Export To Excel</button>
                            </div>
                    @endif
                </div>
            </div>
            <div class="card table-responsive ms-3 me-3 mt-2 mb-4">
                <table id="myTable" class="table table-lg table-striped table-hover" id="dataTable">
                    <thead class="thead-dark table-primary">
                        <tr>
                            <th>#</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            @if (Auth::user() && Auth::user()->role == 'admin')
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php($no = ($persediaan->currentPage() - 1) * $persediaan->perPage() + 1)
                        @foreach ($persediaan as $item)
                            @if ($item->jumlah > 0)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->kode_barang }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->kategori }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    @if (Auth::user() && Auth::user()->role == 'admin')
                                        <td>
                                            <form action="{{ route('persediaan.destroy', $item->id) }}" method="POST"
                                                class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger delete-button"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-custom d-flex-end justify-content me-3 ms-3">
                {{ $persediaan->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>
    </div>

    <!-- SheetJS (xlsx) library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <script>
        @if (Auth::user() && Auth::user()->role == 'admin')
            document.getElementById('downloadButton').addEventListener('click', function() {
                var wb = XLSX.utils.table_to_book(document.getElementById('dataTable'), {
                    sheet: "Sheet1"
                });

                // Add styling to header row
                var ws = wb.Sheets["Sheet1"];
                var range = XLSX.utils.decode_range(ws['!ref']);
                for (var C = range.s.c; C <= range.e.c; ++C) {
                    var cell_address = XLSX.utils.encode_cell({
                        r: range.s.r,
                        c: C
                    });
                    if (!ws[cell_address]) continue;

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
                }

                XLSX.writeFile(wb, 'Laporan_Persediaan.xlsx');
            });
        @endif

        // Add event listener to search form
        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            var searchText = document.getElementById('searchInput').value.toLowerCase();

            // Loop through each row and show/hide based on search text
            var tableRows = document.getElementById('dataTable').querySelectorAll('tbody tr');
            tableRows.forEach(function(row) {
                var rowText = row.innerText.toLowerCase(); // Get entire row text

                if (rowText.includes(searchText)) {
                    row.style.display = ''; // Show row if the text matches the searchText
                } else {
                    row.style.display = 'none'; // Hide row if the text does not match the searchText
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
@endsection --}}
