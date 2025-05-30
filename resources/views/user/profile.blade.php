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

</section>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
