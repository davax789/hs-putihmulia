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
    width: 120px;
    height: 90px;
}

.img-thumbnail {
    width: 100%;
    height: 90px;
    object-fit: cover;
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
.gallery-grid {
  min-height: 284px;
}
.main-image img,
.thumb img {
  cursor: pointer;
  transition: filter 0.2s, box-shadow 0.2s;
}
.main-image img:hover,
.thumb img:hover {
  filter: brightness(0.96);
  box-shadow: 0 4px 18px rgba(0,0,0,0.16);
}
@media (max-width: 768px) {
  .gallery-grid {
    flex-direction: column;
    gap: 10px;
  }
  .main-image, .thumbs {
    width: 100% !important;
    min-width: 0;
    min-height: 0;
  }
  .thumbs {
    flex-direction: row !important;
  }
  .thumb img {
    height: 70px !important;
  }
  body {
  overflow-x: hidden;
}

.container {
  max-width: 100%;
  overflow-x: hidden;
}
/* Hapus scroll horizontal dari seluruh halaman */
html, body {
  margin: 0;
  padding: 0;
  overflow-x: hidden;
  max-width: 100vw;
}

/* Pastikan semua gambar tidak melewati lebar parent */
img {
  max-width: 100%;
  height: auto;
  display: block;
}
    .flatpickr-calendar {
        font-size: 12px !important; /* ukuran teks dalam kalender */
    }

    .flatpickr-input {
        font-size: 12px; /* ukuran input */
        padding: 6px 8px;
    }


}

    </style>
</head>
<body>

    @include('layouts.navbar')

    <!-- Modal Zoom -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body text-center p-0">
        <img id="modalImage" src="" alt="Zoomed Image" class="img-fluid rounded">
      </div>
    </div>
  </div>
</div>

<div class="container py-5" style="overflow-x: hidden; max-width: 90%;">

@foreach ($kamars as $kamar)
    @php
        $mainImage = $kamar->photo_utama ?? 'images/default.jpg';
        $thumbnails = $kamar->photoKamar->sortBy('id')->values()->take(4); // Ambil max 4 gambar kecil
    @endphp

    <div class="row mb-5">
        <div class="col-12">
            <div class="gallery-grid d-flex flex-wrap rounded shadow-sm overflow-hidden" style="gap: 5px;">
                <!-- Gambar besar di kiri -->
                <div class="main-image" style="flex: 1 1 0;">
                    <img
                        src="{{ asset('storage/' . $mainImage) }}"
                        class="img-fluid w-100 h-100 object-fit-cover rounded zoomable-img"
                        style="min-height:284px; aspect-ratio: 4/3;"
                        alt="Foto Utama Kamar">
                </div>

                <!-- Gambar 2-5 di kanan -->
                <div class="thumbs" style="flex: 1 1 0; min-width: 100px;">
                    <div class="row row-cols-2 g-2 h-100">
                        @foreach($thumbnails as $thumb)
                            <div class="col">
                                <img
                                    src="{{ asset('storage/' . $thumb->photo_path) }}"
                                    class="img-fluid w-100 object-fit-cover rounded zoomable-img h-100"
                                    style="aspect-ratio: 16/9;"
                                    alt="Thumbnail">
                            </div>
                        @endforeach
                    </div>
                </div>
                </div>
            </div>
        </div>



        {{-- Deskripsi & Booking card dalam satu row --}}
        <div class="row mb-4">
            <div class="col-md-6 mb-4">
                <h2 class="fw-bold">{{ $kamar->jenisKamar }}</h2>
                <p class="text-muted">{{ $kamar->nomorKamar }}</p>
                <div class="mb-4">
                    <h5 class="fw-semibold">Deskripsi</h5>
                    @php
    $deskripsi = explode(',', $kamar->deskripsi);
    $ikon = [
    'sofa'           => 'fa-bed',
    'king'            => 'fa-bed',
    'double'          => 'fa-bed',
    'single'          => 'fa-bed',
    'ranjang'         => 'fa-bed',
    'tempat tidur'    => 'fa-bed',
    'kasur'           => 'fa-bed',
    'kamar'           => 'fa-door-open',

    'wifi'            => 'fa-wifi',
    'wi-fi'           => 'fa-wifi',
    'internet'        => 'fa-wifi',
    'tv'              => 'fa-tv',
    'televisi'        => 'fa-tv',
    'ac'              => 'fa-snowflake',
    'pendingin'       => 'fa-snowflake',
    'kipas'           => 'fa-fan',

    'kamar mandi'     => 'fa-shower',
    'shower'          => 'fa-shower',
    'bathtub'         => 'fa-bath',
    'air panas'       => 'fa-fire',
    'water heater'    => 'fa-fire',
    'toilet'          => 'fa-toilet-paper',

    'sofa'            => 'fa-couch',
    'meja'            => 'fa-chair',
    'kursi'           => 'fa-chair',
    'lemari'          => 'fa-archive',
    'almari'          => 'fa-archive',
    'rak'             => 'fa-archive',
    'dapur'           => 'fa-kitchen-set',
    'kompor'          => 'fa-fire-burner',
    'kulkas'          => 'fa-temperature-low',
    'microwave'       => 'fa-microwave',
    'rice cooker'     => 'fa-bowl-rice',
    'sarapan'         => 'fa-coffee',
    'aqua'            => 'fa-glass-water',
    'air minum'       => 'fa-glass-water',

    'balkon'          => 'fa-umbrella-beach',
    'teras'           => 'fa-tree',
    'view'            => 'fa-mountain',
    'parkir'          => 'fa-square-parking',
    'halaman'         => 'fa-tree',

    // Umum dan
    ];
@endphp
<ul class="list-unstyled">
    @foreach ($deskripsi as $item)
        @php
            $item = trim(strtolower($item));
            $iconClass = 'fa-check';
            foreach ($ikon as $kata => $fa) {
                if (str_contains($item, strtolower($kata))) {
                    $iconClass = $fa;
                    break;
                }
            }
        @endphp
        <li>
            <i class="fa {{ $iconClass }} text-danger me-2"></i>
            {{ $item }}
        </li>
    @endforeach
</ul>
                </div>
                <div class="mb-4">
                    <h4 class="text-danger fw-bold">
                        Rp {{ number_format($kamar->hargaPermalam, 0, ',', '.') }}
                        <small class="text-muted fs-6">/ malam</small>
                    </h4>
                    <p class="text-success mb-0">
                        <i class="fa fa-check-circle me-1"></i> Termasuk pajak & layanan
                    </p>
                </div>
            </div>
            <!-- Booking Card -->
            <div class="col-md-6 mb-4">
                <div class="booking-card border p-4 rounded shadow-sm">
                    <div class="price-info mb-3">
                        <p class="final-price fs-4 fw-bold text-danger">
                          Rp {{ number_format($kamar->hargaPermalam, 0, ',', '.') }}
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
                            <p class="mb-1">Tipe Kamar</p>
                            <span>{{ $kamar->jenisKamar }}</span>
                        </div>
                    </div>
                    <div class="savings mb-3">
                        <p>Total harga
                        <span id="total-harga" class="highlight fw-bold text-success" data-harga="{{ $kamar->hargaPermalam }}">
                         Rp {{ number_format($kamar->hargaPermalam, 0, ',', '.') }}
                        </span>

                        </p>
                    </div>
                    <button class="book-now btn btn-danger w-100">PESAN SEKARANG</button>
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
    <script>
    const checkinInput = document.getElementById('checkin-date');
    const checkoutInput = document.getElementById('checkout-date');

    checkinInput.addEventListener('change', function () {
        checkoutInput.min = this.value;
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const thumbnails = document.querySelectorAll('.img-thumbnail');
        const modalImage = document.getElementById('modalImage');

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function () {
                const src = this.getAttribute('src');
                modalImage.setAttribute('src', src);
                const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
                imageModal.show();
            });
        });
    });
</script>
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const today = new Date().toISOString().split('T')[0]; // format YYYY-MM-DD

        flatpickr("#checkin-date", {
            defaultDate: today,
            minDate: today,
            dateFormat: "Y-m-d"
        });

        flatpickr("#checkout-date", {
            defaultDate: today,
            minDate: today,
            dateFormat: "Y-m-d"
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const hargaPerMalam = parseInt(document.getElementById('total-harga').dataset.harga);

        const checkinInput = document.getElementById("checkin-date");
        const checkoutInput = document.getElementById("checkout-date");
        const totalHargaSpan = document.getElementById("total-harga");

        function hitungTotalHarga() {
            const checkinDate = new Date(checkinInput.value);
            const checkoutDate = new Date(checkoutInput.value);

            if (checkinDate && checkoutDate && checkoutDate > checkinDate) {
                const oneDay = 24 * 60 * 60 * 1000;
                const diffDays = Math.round((checkoutDate - checkinDate) / oneDay);
                const total = hargaPerMalam * diffDays;

                totalHargaSpan.textContent = "Rp " + total.toLocaleString("id-ID");
            } else {
                totalHargaSpan.textContent = "Rp " + hargaPerMalam.toLocaleString("id-ID");
            }
        }

        flatpickr("#checkin-date", {
            defaultDate: new Date(),
            minDate: "today",
            dateFormat: "Y-m-d",
            onChange: hitungTotalHarga
        });

        flatpickr("#checkout-date", {
            defaultDate: new Date(),
            minDate: "today",
            dateFormat: "Y-m-d",
            onChange: hitungTotalHarga
        });

        // Hitung awal saat load
        hitungTotalHarga();
    });
</script>


</body>
</html>
