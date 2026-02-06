@extends('layouts.main')

@section('contents')

<br>
{{-- Widget --}}
@if(Auth::user()->id == 2)
<div class="row">
    <div class="col-sm-3 col-md-4">
        <div class="card bg-success bg-opacity-75 text-white">
            <div class="card-body">
                <p class="bi bi-basket-fill fw-bold fs-4"> Total Persediaan</p>
                <h2 class="fs-2">{{ $totalStok }}</h2>
            </div>
        </div>
    </div>
    <div class="col-sm-3 col-md-4">
        <div class="card bg-warning bg-opacity-75 text-white">
            <div class="card-body">
                <p class="bi bi-box-seam-fill fw-bold fs-4"> Barang Masuk</p>
                <h2 class="fs-2">{{ $totalMasuk }}</h2>
            </div>
        </div>
    </div>
    <div class="col-sm-3 col-md-4">
        <div class="card bg-danger bg-opacity-75 text-white">
            <div class="card-body">
                <p class="bi bi-box-seam fw-bold fs-4"> Barang Keluar</p>
                <h2 class="fs-2">{{ $totalKeluar }}</h2>
            </div>
        </div>
    </div>
</div>
@endif
{{-- Akhir WIDGET --}}

<br>
{{-- Carousel --}}
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner mt-2 rounded">
            <div class="carousel-item active">
                <img src="image/kopi.jpg" class="img-fluid w-100" style="height: 300px; width: 1000px; object-fit: cover"
                    alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="font-weight: bold;">Biji Kopi Pilihan</h5>
                    <p></p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="image/menu.jpeg" class="d-block w-100" style="height: 300px; width: 1000px; object-fit: cover"
                    alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="color: black; font-weight: bold;">Harga Murah Kualitas Tinggi</h5>
                </div>
            </div>
            <div class="carousel-item">
                <img src="image/tempat.jpeg" class="d-block w-100" style="height: 300px; width: 1000px; object-fit: cover"
                    alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="font-weight: bold;">Tempat yang nyaman</h5>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    {{-- Akhir Carousel --}}

    {{-- Profiling --}}
    <div class="col-lg mt-4">
        <div class="card border-0  bg-light">
            <div class="card-body text-center">
                <h5 class="card-title">KOPTE - APLIKASI PERSEDIAAN BAHAN BAKU</h5>
                <p class="card-text">KOPTE adalah kedai kopi yang menjual berbagai jenis minuman mulai dari coffee
                    dan Non-coffee,
                    Tidak hanya menjual minum saja kedai ini juga menjual berbagai macam makanan. LOW PRICE HIGH QUALITY
                </p>
            </div>
        </div>
    </div>
    {{-- Akhir Profiling --}}

@endsection
