<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homestay Putih Mulia</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="{{ asset('images/favicon-180.png') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


</head>
<body>
@auth
    {{-- Jika user sudah login --}}
    @include('layouts.navbar')
@endauth

@guest
    {{-- Jika user belum login --}}
    @include('layouts.logindaftar')
@endguest    <!-- Hero Section -->

    @section('content')
<div class="container my-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
       @foreach($kamars as $kamar)
    <div class="col">
        <div class="card h-100 shadow-sm border-0">
            <img src="{{ asset('storage/' . $kamar->photo_utama) }}" class="card-img-top" style="height: 200px; object-fit: cover;"
                     alt="Foto Kamar">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $kamar->nomorKamar ?? 'Tipe Kamar' }}</h5>
                <p class="card-text text-muted">{{ Str::limit(strip_tags($kamar->deskripsi), 100) }}</p>
                <h6 class="mt-auto text-primary">Rp {{ number_format($kamar->hargaPermalam, 0, ',', '.') }}/malam</h6>
            </div>
            <div class="card-footer bg-transparent border-top-0 text-center">
                <a href="{{ route('booking.kamar', $kamar->nomorKamar) }}" class="btn btn-outline-primary w-100">Book Now</a>
            </div>
        </div>
    </div>
@endforeach

    </div>

    <div class="mt-4">
        {{-- {{ $kamars->links() }} --}}
    </div>
</div>

    @include('layouts.footer')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</body>
</html>
