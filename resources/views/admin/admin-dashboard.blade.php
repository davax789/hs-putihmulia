<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>

<div class="sidebar p-4">
  <h4 class="text-white" style="text-align: center">Admin</h4>
  <a href="#"><i class="fas fa-chart-line me-2"></i> Dashboard</a>
  <a href="#"><i class="fas fa-shopping-cart me-2"></i> Orders</a>
  <a href="#"><i class="fas fa-door-open me-2"></i> Rooms</a>
  <a href="#"><i class="fas fa-users me-2"></i> Users</a>
  <a href="{{ route('logout') }}" class="logout-link"
     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fas fa-sign-out-alt me-2"></i> Logout
  </a>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
  </form>
</div>

<div class="topbar d-flex justify-content-between align-items-center">
  <h5 class="mb-0 fw-bold">Dashboard Overview</h5>
  <span class="text-muted">Welcome {{ Auth::user()->name }}</span>
</div>

<div class="content">
  <div class="row">
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm p-3 bg-white">
        <div class="card-body">
          <h5><i class="fas fa-receipt text-primary me-2"></i>Total Orders</h5>
          <p class="text-muted fs-5">db</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm p-3 bg-white">
        <div class="card-body">
          <h5><i class="fas fa-bed text-success me-2"></i>Available Rooms</h5>
          <p class="text-muted fs-5">db</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="card shadow-sm p-3 bg-white">
        <div class="card-body">
          <h5><i class="fas fa-user-check text-warning me-2"></i>Active Users</h5>
          <p class="text-muted fs-5">db</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabel Booking dengan Search -->
  <div class="card shadow-sm bg-white">
    <div class="card-body">
      <h5 class="card-title mb-4">
        <i class="fas fa-calendar-check me-2"></i>Recent Bookings
      </h5>
      <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search by Customer...">
      </div>
      <div class="table-responsive">
        <table class="table table-hover align-middle" id="bookingTable">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Customer</th>
              <th>Room</th>
              <th>Check-In</th>
              <th>Check-Out</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>db</td>
              <td><span class="badge bg-primary">Deluxe</span></td>
              <td>2025-05-01</td>
              <td>2025-05-03</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Budi</td>
              <td><span class="badge bg-success">Standard</span></td>
              <td>2025-05-02</td>
              <td>2025-05-04</td>
            </tr>
            <!-- Tambahkan baris lain di sini -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('js/main.js') }}"></script>

</body>
</html>..
