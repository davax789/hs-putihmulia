<!DOCTYPE html>
<html lang="id">
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
     <style>
        .img-thumbnail {
    object-fit: cover;
    cursor: pointer;
    transition: all 0.3s ease;
}

.img-thumbnail:hover {
    opacity: 0.8;
    transform: scale(1.05);
}


.booking-card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    width: 300px;
    padding: 20px;
    margin-left: auto; /* ini akan dorong ke kanan */
    margin-right: 20px; /* ini akan dorong ke kiri */
}

.price-info {
    margin-bottom: 20px;
}

.original-price {
    text-decoration: line-through;
    color: gray;
    font-size: 0.9em;
}

.discount {
    color: #f9a825;
    font-size: 0.9em;
}

.final-price {
    font-size: 1.5em;
    font-weight: bold;
    margin-top: 5px;
}

.rating {
    display: flex;
    align-items: center;
    margin-top: 10px;
    font-size: 0.9em;
}

.rating span:first-child {
    background-color: #4285f4;
    color: white;
    border-radius: 4px;
    padding: 2px 6px;
    margin-right: 4px;
}

.details {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 10px;
    margin-bottom: 10px;
}

.check, .rooms {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

.divider {
    width: 1px;
    background-color: #e0e0e0;
    height: 40px;
    margin: 0 10px;
}

.type {
    margin-bottom: 10px;
}

.type p {
    margin: 0;
    padding-bottom: 5px;
    font-weight: bold;
}

.savings {
    font-size: 0.9em;
    margin-bottom: 15px;
}

.highlight {
    float: right;
    font-weight: bold;
}

.book-now {
    background-color: #f44336;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    width: 100%;
    font-size: 1em;
    font-weight: bold;

}

.book-now:hover {
    background-color: #e53935;
}
.date-input {
    padding: 5px 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
    font-family: inherit;
    font-size: 14px;
    width: 100%;
    box-sizing: border-box;
}

    </style>
</head>
<body>

    @include('layouts.navbar')

    <div class="container py-5">
        <div class="row">
            <!-- Gambar Utama -->
            <div class="col-md-6">
                <img src="{{ asset('images/room1.jpeg') }}" class="img-fluid rounded shadow-sm" alt="Foto Kamar">
                <div class="mt-3 d-flex gap-2">
                    <!-- Thumbnail -->
                    <img src="{{ asset('images/room1.jpeg') }}" class="img-thumbnail" style="width: 80px; height: 60px;" alt="">
                    <img src="{{ asset('images/room2.jpeg') }}" class="img-thumbnail" style="width: 80px; height: 60px;" alt="">
                    <img src="{{ asset('images/room3.jpeg') }}" class="img-thumbnail" style="width: 80px; height: 60px;" alt="">
                </div>
            </div>

            <!-- Info Detail -->
            <div class="col-md-6">
                <h2 class="fw-bold">Deluxe Room</h2>
                <p class="text-muted">Homestay Putih Mulia</p>
                <!-- Fasilitas -->
                <div class="mb-3">
                    <h5 class="fw-semibold">Fasilitas</h5>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-bed text-danger me-2"></i>1 Ranjang Queen Size</li>
                        <li><i class="fa fa-wifi text-danger me-2"></i>WiFi Gratis</li>
                        <li><i class="fa fa-tv text-danger me-2"></i>TV LED</li>
                        <li><i class="fa fa-snowflake text-danger me-2"></i>AC</li>
                        <li><i class="fa fa-shower text-danger me-2"></i>Kamar Mandi Dalam</li>
                    </ul>
                </div>
                <!-- Harga -->
                <div class="mb-4">
                    <h4 class="text-danger fw-bold">Rp 350.000 <small class="text-muted fs-6">/ malam</small></h4>
                    <p class="text-success mb-0"><i class="fa fa-check-circle me-1"></i> Termasuk pajak & layanan</p>
                </div>
                <!-- Tombol Pesan -->
                {{-- <a href="{{ route('pesan.kamar', ['id' => 1]) }}" class="btn btn-danger btn-lg w-100"> --}}
                    <i class="fa fa-calendar-check me-2"></i> Pesan Sekarang
                </a>
            </div>
        </div>
    </div>

    <div class="booking-card">
        <div class="price-info">
            <p class="final-price">Rp 180.387</p>
        </div>
        <div class="details">
<div class="check">
    <div class="check-in">
        <p>Check In</p>
        <input type="date" id="checkin-date" class="date-input">
    </div>
    <div class="divider"></div>
    <div class="check-out">
        <p>Check Out</p>
        <input type="date" id="checkout-date" class="date-input">
    </div>
</div>

            <div class="rooms">
                <div class="room-count">
                    <p>Jumlah Kamar</p>
                    <span>1</span>
                </div>
                <div class="divider"></div>
                <div class="guests">
                    <p>Tamu</p>
                    <span>2</span>
                </div>
            </div>
            <div class="type">
                <p>Tipe Kamar</p>
                <span>Standard Room</span>
            </div>
        </div>
        <div class="savings">
            <p>Menghemat sebesar <span class="highlight">Rp 51.001</span></p>
            <p>Total harga <span class="highlight">Rp 180.387</span></p>
        </div>
        <button class="book-now">PESAN SEKARANG</button>
    </div>

    @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
    const checkinInput = document.getElementById('checkin-date');
    const checkoutInput = document.getElementById('checkout-date');

    checkinInput.addEventListener('change', function () {
        checkoutInput.min = this.value;
    });
</script>

</body>
</html>
