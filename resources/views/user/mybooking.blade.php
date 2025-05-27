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
        <style>
        .sidebar-item {
    text-decoration: none;
    color: #333;
    display: block;
    padding: 10px;
    transition: background-color 0.2s;
}

.sidebar-item:hover {
    background-color: #f0f0f0;
}

.sidebar-item.active {
    background-color: #e9ecef;
    font-weight: 500;
}
    </style>
</head>
<body>
    @include('layouts.navbar')

    <!-- Sidebar dan Konten -->
    <section>
        <div class="container py-5">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <a href="{{ route('profile') }}" class="sidebar-item d-block mb-2 {{ request()->routeIs('profile') ? 'active' : '' }}" aria-label="View Profile">
                                <i class="fa fa-user me-2"></i>Profile
                            </a>
                            <a href="{{ route('myBookings') }}" class="sidebar-item d-block {{ request()->routeIs('myBookings') ? 'active' : '' }}" aria-label="View My Bookings">
                                <i class="fa fa-history me-2"></i>My Bookings
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
<div class="col-md-8">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">My Bookings</h5>
        </div>
        <div class="card-body">
            @if($myBookings->isEmpty())
                <p class="text-muted">You have no booking history yet.</p>
            @else
                <ul class="list-group list-group-flush">
                    @foreach($myBookings as $booking)
                        <li class="list-group-item d-flex align-items-start">
                            <!-- Tampilkan gambar -->
                            @if($booking->kamar && $booking->kamar->photo_utama)
                            <img src="{{ asset('storage/' . $booking->kamar->photo_utama) }}" alt="Kamar {{ $booking->noKamar }}" class="img-fluid me-3" style="width: 110px; height: 110px; object-fit: cover;">

                            @else
                                <img src="{{ asset('images/default-room.jpg') }}" alt="Default Kamar" class="img-fluid me-3" style="max-width: 100px; max-height: 100px; object-fit: cover;">
                            @endif
                            <div>
                                <strong>Nama Kamar:</strong> {{ $booking->noKamar }} <br>
                                <strong>Kode Transaksi:</strong> {{ $booking->kode_transaksi }} <br>
                                <strong>Total Pembayaran:</strong> Rp{{ number_format($booking->total_harga, 0, ',', '.') }} <br>
                                <strong>Status:</strong> {{ $booking->status }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
