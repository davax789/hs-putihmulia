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
    @include('layouts.navbar')

<!-- Hero Section -->
<div class="container mt-4">
    @foreach ($kamars as $pemesanan)
    <div class="row">
        {{-- Form Pemesanan (KIRI) --}}
        <div class="col-md-7">
            <form action="" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $pemesanan->email }}" readonly>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label>Title</label>
                        <select name="title" class="form-control">
                            <option {{ $pemesanan->title == 'Mr' ? 'selected' : '' }}>Mr</option>
                            <option {{ $pemesanan->title == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label>Nama Depan</label>
                        <input type="text" name="nama_depan" class="form-control" value="{{ $pemesanan->nama_depan }}">
                    </div>
                    <div class="col-md-5">
                        <label>Nama Belakang</label>
                        <input type="text" name="nama_belakang" class="form-control" value="{{ $pemesanan->nama_belakang }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Nomor Telepon</label>
                    <div class="d-flex">
                        <span class="input-group-text">+62</span>
                        <input type="text" name="telepon" class="form-control" value="{{ $pemesanan->telepon }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label>Kebangsaan</label>
                    <select name="kebangsaan" class="form-control">
                        <option {{ $pemesanan->kebangsaan == 'INDONESIA' ? 'selected' : '' }}>INDONESIA</option>
                        <option {{ $pemesanan->kebangsaan != 'INDONESIA' ? 'selected' : '' }}>Others</option>
                    </select>
                </div>
            </form>
        </div>

        {{-- Ringkasan Transaksi --}}
        <div class="col-md-5">
            <div class="booking-card border p-4 rounded shadow-sm">
                <div class="price-info mb-3">
                    <p class="final-price fs-4 fw-bold text-danger">
                        Rp {{ number_format($pemesanan->hargaPermalam, 0, ',', '.') }}
                    </p>
                </div>

                <div class="details mb-3">
                    <div class="check d-flex mb-3">
                        <div class="check-in me-3 flex-fill">
                            <p class="mb-1">Check In</p>
                            <input type="text" id="checkin-date" class="form-control date-input flatpickr" placeholder="Pilih tanggal check-in">
                        </div>
                        <div class="check-out flex-fill">
                            <p class="mb-1">Check Out</p>
                            <input type="text" id="checkout-date" class="form-control date-input flatpickr" placeholder="Pilih tanggal check-out">
                        </div>
                    </div>
                    <div class="rooms d-flex mb-3">
                        <div class="room-count me-3 flex-fill">
                            <p class="mb-1">Jumlah Kamar</p>
                            <span>1</span>
                        </div>
                        <div class="guests flex-fill">
                            <p class="mb-1">Tamu</p>
                            <span>2</span>
                        </div>
                    </div>
                    <div class="type mb-3">
                            <p class="mb-1"><strong>Tipe Kamar</strong></p>
                        <span>{{ $pemesanan->jenisKamar }}</span>
                    </div>
                </div>

                <div class="savings mb-3">
                    <p>Total harga
                        <span id="total-harga" class="highlight fw-bold text-success" data-harga="{{ $pemesanan->hargaPermalam }}">
                            Rp {{ number_format($pemesanan->hargaPermalam, 0, ',', '.') }}
                        </span>
                    </p>
                    <form action="{{ route('transaksi', $pemesanan->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="check_in" id="checkin-date-{{ $pemesanan->id }}">
                        <input type="hidden" name="check_out" id="checkout-date-{{ $pemesanan->id }}">
                        <button type="submit" class="book-now btn btn-danger w-100">PESAN SEKARANG</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>


    @include('layouts.footer')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

</body>
</html>
