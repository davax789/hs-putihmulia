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
@endguest

    <!-- Hero Section -->
    <section class="hero-section position-relative">
        <!-- Gambar Background -->
        <div class="hero-bg">
            <img src="images/background1.jpg" class="bg-slide active" alt="Slide 1">
            <img src="images/background2.jpg" class="bg-slide" alt="Slide 2">
            <img src="images/background3.jpg" class="bg-slide" alt="Slide 3">
        </div>

        <!-- Tombol Navigasi -->
        <button class="slide-btn left">&#10094;</button>
        <button class="slide-btn right">&#10095;</button>

        <!-- Konten -->
        <div class="container position-relative z-2 text-white text-center">
            <h1 class="display-4 fw-bold">Book Your Perfect Stay</h1>
            <p class="lead">Discover affordable hotels with the best deals!</p>
            <div class="search-box mt-4">
                <form action="#" method="GET">
                    <div class="row g-3 align-items-center justify-content-center">
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Find your favorite room" name="destination">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="checkin" id="checkin" placeholder="Check-in">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="checkout" id="checkout" placeholder="Check-out">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <!-- Promo Section -->
<section class="promo-section">
    <div class="container">
        <h2 class="text-center mb-5">Explore Our Promotions</h2>
        <div class="row">
            @foreach($kamars as $kamar)
            <div class="col-md-4 mb-4">
                <div class="card promo-card h-100 d-flex flex-column">
                    <img src="{{ asset('storage/' . $kamar->photoKamar) }}"
                         alt="Room Image"
                         style="width: 100%; height: 150px; object-fit: cover;"
                         class="card-img-top rounded">
                    <div class="card-body d-flex flex-column" style="min-height: 200px;">
                        <h5 class="card-title">{{ $kamar->jenisKamar }}</h5>
                        <p class="card-text flex-grow-1">{{ $kamar->deskripsi }}</p>
                        <a href="{{ route('detail.kamar', $kamar->jenisKamar) }}" class="btn btn-outline-primary mt-auto">Book Now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
    @include('layouts.footer')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</body>
</html>
