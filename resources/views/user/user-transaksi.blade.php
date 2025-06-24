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

        {{-- Email --}}
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" value="{{ auth()->user()->email ?? '' }}" disabled>
            </div>
        </div>

        {{-- Title & Nama --}}
        <div class="row mb-3">
            <div class="col-md-5">
                <label for="nama_depan" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_depan" value="{{ auth()->user()->name ?? '' }}" disabled>
            </div>
        </div>

        {{-- Kebangsaan (pilihan) --}}
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="kebangsaan" class="form-label">Kebangsaan</label>
                <select class="form-select" id="kebangsaan" name="kebangsaan">
                    <option value="Indonesia" selected>Indonesia</option>
                    <option value="Abroad">Abroad</option>
                </select>
            </div>
        </div>

        {{-- No HP dengan kode negara --}}
{{-- Nomor HP dengan opsi kode negara --}}
<div class="row mb-3">
    <div class="col-md-4">
        <label for="kode_negara" class="form-label">Kode Negara</label>

        <!-- Wrapper relatif agar posisi select tetap pada kotaknya -->
        <div style="position: relative; width: 100%; max-width: 100px;">
            <!-- Input tampilan kode -->
            <input type="text" id="displayKode" class="form-control" readonly placeholder="+--">

            <!-- Select disembunyikan tapi bisa diklik -->
<select id="kode_negara" name="kode_negara" class="form-select"
    style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer;">

    <option value="+62">🇮🇩 Indonesia +62</option>
    <option value="+673">🇧🇳 Brunei +673</option>
    <option value="+855">🇰🇭 Cambodia +855</option>
    <option value="+856">🇱🇦 Laos +856</option>
    <option value="+60">🇲🇾 Malaysia +60</option>
    <option value="+95">🇲🇲 Myanmar +95</option>
    <option value="+63">🇵🇭 Philippines +63</option>
    <option value="+65">🇸🇬 Singapore +65</option>
    <option value="+66">🇹🇭 Thailand +66</option>
    <option value="+670">🇹🇱 Timor-Leste +670</option>
    <option value="+84">🇻🇳 Vietnam +84</option>
    <option value="+81">🇯🇵 Japan +81</option>
    <option value="+82">🇰🇷 South Korea +82</option>
</select>

        </div>

        <input type="checkbox" name="skip_kode_negara" id="skipKodeNegara">
<label for="skipKodeNegara">No country code</label>

</div>


    <div class="col-md-8">
        <label for="nohp" class="form-label">Nomor HP</label>
        <input type="tel" class="form-control" id="nohp" name="nohp" placeholder="812xxxxxxx" required>
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
        <form action="{{ route('pembayaran') }}" method="POST" class="mt-2">
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
    <script>
    document.getElementById('skipKodeNegara').addEventListener('change', function () {
        const kodeNegaraSelect = document.getElementById('kode_negara');
        const nohpInput = document.getElementById('nohp');

        if (this.checked) {
            kodeNegaraSelect.disabled = true;
            nohpInput.disabled = true;
            nohpInput.removeAttribute('required');
        } else {
            kodeNegaraSelect.disabled = false;
            nohpInput.disabled = false;
            nohpInput.setAttribute('required', 'required');
        }
    });
</script>
<script>
    const select = document.getElementById('kode_negara');
    const display = document.getElementById('displayKode');

    // Set tampilan awal
    display.value = select.value;

    // Update tampilan saat user memilih
    select.addEventListener('change', function () {
        display.value = this.value;
    });
</script>

</body>
</html>
