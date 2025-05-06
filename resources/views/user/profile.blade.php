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
    <!-- Sidebar dan Konten -->
<section>
    <div class="container py-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="sidebar-item active" id="profileMenuItem">
                            <i class="fa fa-user me-2"></i>Profile
                        </div>
                        <div class="sidebar-item" id="historyMenuItem">
                            <i class="fa fa-history me-2"></i>My Bookings
                        </div>
                    </div>
                </div>
            </div>

            <!-- Konten Utama -->
            <div class="col-md-8">
                <!-- Profile Section -->
                <div id="profileSection">
                    <div class="profile-header">
                        <div class="profile-info d-flex align-items-center">
                            <img src="{{ asset('images/avatar.png') }}" alt="Profile Avatar" class="rounded-circle" width="80" height="80">
                            <div class="ms-3">
                                <h5>{{ Auth::user()->name }}</h5>
                                <p class="text-muted">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success mt-2">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" name="name" id="fullName" value="{{ Auth::user()->name }}" placeholder="Your Full Name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->email }}" disabled>
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Booking History Section (dipisah dari profile) -->
                <div id="bookingHistorySection" style="display: none;">
                    <div class="card shadow-sm mt-3">
                        <div class="card-header bg-white">
                            <h5 class="mb-0">My Bookings</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">You have no booking history yet.</p>
                        </div>
                    </div>
                </div>
            </div> <!-- .col-md-8 -->
        </div> <!-- .row -->
    </div> <!-- .container -->
</section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>
</html>
