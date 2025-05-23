<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container-custom {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }
        .card-custom {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .summary-card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 20px;
        }
        .btn-pay {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px;
            font-weight: bold;
            border-radius: 5px;
            width: 100%;
        }
        .btn-pay:hover {
            background-color: #c82333;
        }
        .form-label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-control:disabled {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
        }
        .text-muted-small {
            font-size: 0.85rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
@auth
    @include('layouts.navbar')
@endauth

@guest
    @include('layouts.logindaftar')
@endguest
    <div class="container-custom">
        <div class="row">
            <!-- Form Detail Pemesan -->
            <div class="col-md-8 mb-4">
                <div class="card card-custom p-4">
                    <h5 class="mb-3">Saya memesan untuk</h5>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ auth()->user()->email ?? '' }}" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" value="Mr" disabled>
                        </div>
                        <div class="col-md-5">
                            <label for="nama_depan" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_depan" value="{{ auth()->user()->name ?? '' }}" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input type="text" class="form-control" id="nomor_telepon">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="kebangsaan" class="form-label">Kebangsaan</label>
                            <input type="text" class="form-control" id="kebangsaan" value="INDONESIA" disabled>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ringkasan Pemesanan -->
            <div class="col-md-4 mb-4">
    <div class="card summary-card p-3">
        <img src="{{ asset('storage/' . $kamar->photo_utama) }}"
             alt="Gambar Kamar {{ $kamar->nomorKamar }}"
             class="img-fluid rounded mb-2" style="max-height: 100px; object-fit: cover; width: 100%;">
        <h6 class="mb-2"><strong>{{ $kamar->nomorKamar }}</strong></h6>
        <p class="text-muted mb-2" style="font-size: 0.9rem;">{{ $kamar->jenisKamar }}</p>
        <div class="row mb-2">
            <div class="col-6">
                <small class="text-muted">CHECK IN</small><br>
                {{ \Carbon\Carbon::parse($check_in)->translatedFormat('D, d M') }}
            </div>
            <div class="col-6">
                <small class="text-muted">CHECK OUT</small><br>
                {{ \Carbon\Carbon::parse($check_out)->translatedFormat('D, d M') }}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-6">
                <small class="text-muted">Kamar</small><br>
                1
            </div>
            <div class="col-6">
                <small class="text-muted">Tamu</small><br>
                2
            </div>
        </div>
        <hr class="my-2">
        <div class="d-flex justify-content-between mb-2">
            <small class="text-muted">Jumlah biaya:</small>
            <strong>Rp {{ number_format($total_harga, 0, ',', '.') }}</strong>
        </div>
        <form action="{{ route('transaksi.confirm') }}" method="POST" class="mt-2">
            @csrf
            <input type="hidden" name="kamar_id" value="{{ $kamar->id }}">
            <input type="hidden" name="check_in" value="{{ $check_in }}">
            <input type="hidden" name="check_out" value="{{ $check_out }}">
            <input type="hidden" name="jumlah_kamar" value="1">
            <input type="hidden" name="jumlah_tamu" value="2">
            <button type="submit" class="btn btn-danger btn-sm w-100">Bayar Sekarang</button>
        </form>
    </div>
</div>
</div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
