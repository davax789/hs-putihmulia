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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <h5>Putih Mulia</h5>
            </a>
            <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="toggler-icon">
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="bar top-bar" d="M5 7H25" stroke="#333" stroke-width="2" stroke-linecap="round"/>
                        <path class="bar middle-bar" d="M5 15H25" stroke="#333" stroke-width="2" stroke-linecap="round"/>
                        <path class="bar bottom-bar" d="M5 23H25" stroke="#333" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <button class="nav-link btn btn-primary text-dark ms-3 btn-oval" data-bs-toggle="modal" data-bs-target="#authModal">Login | Daftar</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold">Book Your Perfect Stay</h1>
            <p class="lead">Discover affordable hotels with the best deals!</p>
            <div class="search-box mt-4">
                {{-- <form action="{{ route('search') }}" method="GET"> --}}
                    <div class="row g-3 align-items-center justify-content-center">
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Find your favorite room" name="destination">
                        </div>
                        <div class="col-md-3">
                            <!-- Flatpickr untuk input check-in dengan placeholder lebih ringkas -->
                            <input type="text" class="form-control" name="checkin" id="checkin" placeholder="Check-in">
                        </div>
                        <div class="col-md-3">
                            <!-- Flatpickr untuk input check-out dengan placeholder lebih ringkas -->
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
                <div class="col-md-4 mb-4">
                    <div class="card promo-card">
                        <img src="https://via.placeholder.com/400x200?text=Promo+1" class="card-img-top" alt="Promo 1">
                        <div class="card-body">
                            <h5 class="card-title">Stay 3 Nights, Pay 2</h5>
                            <p class="card-text">Book now and enjoy an extra night!</p>
                            <a href="#" class="btn btn-outline-primary">Book Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card promo-card">
                        <img src="https://via.placeholder.com/400x200?text=Promo+2" class="card-img-top" alt="Promo 2">
                        <div class="card-body">
                            <h5 class="card-title">Weekend Getaway</h5>
                            <p class="card-text">Up to 30% off for weekend stays.</p>
                            <a href="#" class="btn btn-outline-primary">Book Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card promo-card">
                        <img src="https://via.placeholder.com/400x200?text=Promo+3" class="card-img-top" alt="Promo 3">
                        <div class="card-body">
                            <h5 class="card-title">Family Package</h5>
                            <p class="card-text">Special deals for family vacations.</p>
                            <a href="#" class="btn btn-outline-primary">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <p>© {{ date('Y') }} Putih Mulia. All rights reserved.</p>
            <div>
                <a href="#" class="text-muted me-3">Privacy Policy</a>
                <a href="#" class="text-muted me-3">Terms of Service</a>
                <a href="#" class="text-muted">Contact Us</a>
            </div>
        </div>
    </footer>

    <!-- Login Modal -->
    <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="authModalLabel">Selamat Datang !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Tombol Login Sosial -->

                    <div class="social-login mb-3">
                        <a href="{{ url('/auth/facebook/redirect') }}" class="btn btn-social btn-facebook w-100 mb-2">
                            <i class="fab fa-facebook-f me-2"></i> Login dengan Facebook
                        </a>
                        <a href="{{ url('/auth/redirect') }}" class="btn btn-social btn-google w-100">
                            <i class="fab fa-google me-2"></i> Login dengan Google
                        </a>
                    </div>
                    <!-- Pemisah -->
                    <div class="divider my-3 text-center">
                        <span class="divider-text">dengan Email dan Password</span>
                    </div>
                    <!-- Login Form -->
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        @if ($errors->has('login_error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $errors->first('login_error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="loginEmail" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="loginPassword" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-rounded w-100">Login</button>
                        <p class="text-center mt-3">
                            Belum punya akun? <a href="#" class="switch-to-register text-primary" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-dismiss="modal">Daftar di sini</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="registerModalLabel">Selamat Datang !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Tombol Register Sosial -->
                    <div class="social-login mb-3">
                        <a href="{{ url('/auth/facebook/redirect') }}" class="btn btn-social btn-facebook w-100 mb-2">
                            <i class="fab fa-facebook-f me-2"></i> Daftar dengan Facebook
                        </a>
                        <a href="{{ url('/auth/redirect') }}" class="btn btn-social btn-google w-100">
                            <i class="fab fa-google me-2"></i> Daftar dengan Google
                        </a>
                    </div>
                    <!-- Pemisah -->
                    <div class="divider my-3 text-center">
                        <span class="divider-text">Atau daftar dengan Email</span>
                    </div>
                    <!-- Register Form -->
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="registerName" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="registerName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="registerEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="registerPassword" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerPasswordConfirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="registerPasswordConfirmation" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-rounded w-100">Daftar</button>
                        <p class="text-center mt-3">
                            Sudah punya akun? <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#authModal" data-bs-dismiss="modal">Login di sini</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/main.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @if ($errors->has('login_error'))
<script>
    var myModal = new bootstrap.Modal(document.getElementById('authModal'));
    myModal.show();
</script>
@endif
</body>
</html>
