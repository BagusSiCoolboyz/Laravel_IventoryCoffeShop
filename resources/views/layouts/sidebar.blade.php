<div class="col-lg-3">
    <nav class="navbar navbar-expand-lg bg-light rounded border mt-2 cus-side">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start fixed-sidebar" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel" style="width: 250px">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel"> KOPTE SURADITA </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav nav-pills flex-column justify-content-end flex-grow-1">
                        <li class="nav-item">INFORMASI
                            <a class="nav-link link-dark {{ $title === 'Home' ? 'active' : '' }} bi bi-house-door-fill ps-2"
                                aria-current="page" href="{{ route('home') }}"> Beranda</a>
                        </li>
                        <li class="nav-item">{{ $judul }}
                            <a class="nav-link link-dark {{ $title === 'Persediaan' ? 'active' : '' }} bi bi-basket ps-2"
                                href="{{ route('persediaan') }}">
                                Persediaan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-dark {{ $title === 'Barang Masuk' ? 'active' : '' }} bi bi-calendar-plus ps-2"
                                href="{{ route('barang_masuk') }}"> Barang
                                Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-dark {{ $title === 'Barang Keluar' ? 'active' : '' }} bi bi-calendar-x ps-2"
                                href="{{ route('barang_keluar') }}">
                                Barang Keluar</a>
                        </li>
                        @if (Auth::user()->id == 2)
                            <li class="nav-item">LAPORAN DATA
                                <a class="nav-link link-dark {{ $title === 'Laporan Masuk' ? 'active' : '' }} bi bi-folder-plus ps-2"
                                    href="{{ route('laporan-masuk') }}"> Laporan Masuk</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link link-dark {{ $title === 'Laporan Keluar' ? 'active' : '' }} bi bi-folder-minus ps-2"
                                    href="{{ route('laporan-keluar') }}"> Laporan Keluar</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link link-dark {{ $title === 'Laporan Persediaan' ? 'active' : '' }} bi bi-folder ps-2"
                                    href="{{ route('laporan-persediaan') }}"> Laporan Persediaan</a>
                            </li> --}}
                            <li class="nav-item">MASTER DATA
                                <a class="nav-link link-dark {{ $title === 'Data Master' ? 'active' : '' }} bi bi-database ps-2"
                                    href="{{ route('master-data') }}"> Master Data Barang</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

<style>
    /* Gaya untuk menu aktif */
    .nav-link.active {
        background-color: #47663B !important; /* Warna latar belakang hijau */
        color: #ffffff !important; /* Warna teks putih */
        border-radius: 5px; /* Opsional: sudut melengkung */
    }

    /* Gaya untuk menghapus hover default warna biru */
    .nav-link:hover {
        background-color: #5a6f50; /* Warna saat hover (opsional) */
        color: #ffffff !important; /* Pastikan tetap putih */
    }
</style>